<?php

namespace App\Http\Controllers;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\Department;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Button;

use Illuminate\Support\Facades\Auth;
use App\DataTables\StudentsDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function index0()
    {
        return view('admin.admin');

    }

    /**
    * Update the specified resource in storage.
    
    */
    public function update(Request $request, $id)
    {
        $request->validate([
        'motif' => 'required',
        'etat' => 'required',
        'oriented_to_speciality'=>'oriented_to_speciality'
        ]);
        $ii=  $request->id_st;
        $student = Student::find($ii);
        $student->motif = $request->motif;
        $student->etat = $request->etat;
        $student->oriented_to_speciality = $request->oriented_to_speciality;
        $student->save();
        return   back()->with('success','Student Has Been updated successfully');
        /*return redirect()->route('admin.dashboard')
        ->with('success','Student Has Been updated successfully');*/
    }
    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Request $request)
    {
        $com = Student::where('id',$request->id)->delete();
        return Response()->json($com);
    }
    public function student_disable(Request $request)
    {
        $com = Student::where('id',$request->id)->update([
            'is_deleted' => 1
        ]);
        return Response()->json($com);
    }
    public function student_active(Request $request) //(Student $student)
    {
       // $student->update(['is_deleted' => 0 ]);
        $com = Student::where('id',$request->id)->update([
        'is_deleted' => 0 ]);

        return Response()->json($com);
       // return back();
    }


/**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
  

   
    public function generatePDF()
    {

        $id=Auth::user()->faculty_id;
        $faculty=  Faculty::find( $id)->get()->first();
        $students = Student::where(['faculty_id'=>1])->get(['nom_fr','prenom_fr','nom_ar','prenom_ar','date_nais','moy_classement','department_id','special_1','special_2','special_3']);

        $data = [
            'title' => 'La liste des etudiants Master 20% ',
            'date' => date('m/d/Y'),
            'faculty'=>$faculty,
            'students' => $students
        ];
      //  return view('admin.students.pdf_view')->with($data);  // for test
        $pdf =PDF::loadView('admin.students.pdf_view', $data);
    
        return $pdf->download('___List_etudiants.pdf');
    }

    public function list_student(Request $request =null, StudentsDataTable $dataTable)
    {
        $selectedDeparts =  Auth::guard('admin')->user()->faculty->departments()->get();
        $departments= Department:: where('is_active','1')->get();
        $list=[];
        if($selectedDeparts){
            //$idList = $selectedDeparts->pluck('id');
            
            
            foreach ($selectedDeparts as $dep)
            {
            $list[] = $dep->id;
            }
        }
        $dataTable->setDepIds($list);

        if(  ($request->input('dep_id')!== NULL) ) {
                
            $dataTable->setDepIds([$request->input('dep_id')]); 
        }
        return $dataTable->render('admin.students.index_yaj',['departments'=>$departments]); 
    }

    public function show_uploaded_file($id)
    {
        $student= Student::where(['id'=>$id])->get()->first();

        if( $student)
        {
                $file =base_path(). $student->file_path; //app_path()


            if (file_exists($file)) {

                $headers = [
                    'Content-Type' => 'application/pdf'
                ];

                return response()->download($file, 'uploaded_file', $headers, 'inline');
            } else {

                abort(404, 'File not found!');
            }
        }
        else {

            abort(404, 'File not found!');
        }
    }

}
