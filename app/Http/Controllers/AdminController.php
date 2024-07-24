<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Student;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Button;
use Illuminate\Support\Facades\DB;
use App\DataTables\RecoursDataTable;
use Illuminate\Support\Facades\Auth;
use App\DataTables\StudentsDataTable;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

//use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function dashboard()
    {

        $message = ' Your account is disabled';
        if (Auth::guard('admin')->user()->is_active) {
            return view('admin.dashboard');
        } else return view('admin.admin', compact('message'));
    }
    public function index0()
    {
        return view('admin.admin');
    }

    /**
     * Update the specified resource in storage.
    
     */
    //etat update
    public function update(Request $request, $id)
    {
        //I muste validate $request->oriented_to_speciality != null if etat = Accepté
        $request->validate([
            //'motif' => 'required',
            'etat' => 'required',
            // 'oriented_to_speciality'=>'string'
        ]);
        $ii =  $request->id_st;
        $student = Student::find($ii);
        $student->motif = $request->motif;
        $student->etat = $request->etat;
        $student->oriented_to_speciality = $request->oriented_to_speciality;
        $student->save();
        return   back()->with('success', 'Student Has Been updated successfully');
        /*return redirect()->route('admin.dashboard')
        ->with('success','Student Has Been updated successfully');*/
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $com = Student::where('id', $request->id)->delete();
        return Response()->json($com);
    }
    public function student_disable(Request $request)
    {
        $com = Student::where('id', $request->id)->update([
            'is_deleted' => 1
        ]);
        return Response()->json($com);
    }
    public function student_active(Request $request) //(Student $student)
    {
        // $student->update(['is_deleted' => 0 ]);
        $com = Student::where('id', $request->id)->update([
            'is_deleted' => 0
        ]);

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

        $id = Auth::user()->faculty_id;
        $faculty =  Faculty::find($id)->get()->first();
        $students = Student::where(['faculty_id' => 1])->get(['nom_fr', 'prenom_fr', 'nom_ar', 'prenom_ar', 'date_nais', 'moy_classement', 'department_id', 'special_1', 'special_2', 'special_3']);

        $data = [
            'title' => 'La liste des etudiants Master 20% ',
            'date' => date('m/d/Y'),
            'faculty' => $faculty,
            'students' => $students
        ];
        //  return view('admin.students.pdf_view')->with($data);  // for test
        $pdf = PDF::loadView('admin.students.pdf_view', $data);

        return $pdf->download('___List_etudiants.pdf');
    }

    public function list_student(Request $request = null, Faculty $faculty = null, StudentsDataTable $dataTable)
    {
        //Log the request inputs for debugging
        // Log::info('Request Inputs', [
        //     'dep_id' => $request->input('dep_id'),
        //     'licenceType' => $request->input('licenceType')
        // ]);

        $facName_ar =   Auth::guard('admin')->user()->faculty->name_ar;
        $selectedDeparts =  Auth::guard('admin')->user()->faculty->departments()->get();
        $departments = Department::where('faculty_id', Auth::guard('admin')->user()->faculty->id)->where('is_active', '1')->get();
        $facid =  Auth::guard('admin')->user()->faculty->id;
        if ($faculty->exists && (Auth::guard('admin')->user()->hasRole('administrator'))) {
            $selectedDeparts = $faculty->departments()->get();
            $departments = Department::where('faculty_id', $faculty->id)->where('is_active', '1')->get();
            $facName_ar =  $faculty->name_ar;
            $facid = $faculty->id;
        }

        $list = [];
        if ($selectedDeparts) {

            foreach ($selectedDeparts as $dep) {
                $list[] = $dep->id;
            }
        }
        $dataTable->setDepIds($list);
        // if ($request->input('dep_id')!== NULL)

        if ($request->has('dep_id')) {
            $dataTable->setDepIds([$request->input('dep_id')]);
        }
        if ($request->has('licenceType')) {
            //$dataTable->setLicenceType($request->input('licenceType'));
            $licenceType = explode('?', $request->input('licenceType'))[0];  // Sanitize the licenceType input
            $dataTable->setLicenceType($licenceType);
        }
        // Log applied filters for debugging
        // Log::info('Applied Filters', [
        //     'dep_ids' => $dataTable->getDepIds(),
        //     'licenceType' => $dataTable->getLicenceType()
        // ]);
        return $dataTable->render('admin.students.index_yaj', ['departments' => $departments, 'facName_ar' => $facName_ar, 'facid' => $facid]);
    }

    public function show_uploaded_file($id)
    {
        $student = Student::where(['id' => $id])->get()->first();

        if ($student) {
            $file = base_path() . $student->file_path; //app_path()


            if (file_exists($file)) {

                $headers = [
                    'Content-Type' => 'application/pdf'
                ];

                return response()->download($file, 'uploaded_file', $headers, 'inline');
            } else {

                abort(404, 'File not found!');
            }
        } else {

            abort(404, 'File not found!');
        }
    }

    public function etat_refus_all(Department $department)
    {
        $list = Student::where('department_id', $department->id)->where('etat', 'Non traité')->get();
        //update([ 'etat' => 'Refusé'  ]);
        foreach ($list as $student) {
            $student->update([
                'etat' => 'Refusé',
                'motif' => 'عدم توفر أماكن بيداغوجية'
            ]);
        }
        $com = "success";
        //flash('Students etat Successfully updated','success');
        return Response()->json($com);
        // return back();
    }
    public function list_recours(Request $request = null, RecoursDataTable $dataTable)
    {
        $selectedDeparts =  Auth::guard('admin')->user()->faculty->departments()->get();
        $facName =   Auth::guard('admin')->user()->faculty->name_fr;
        $departments = Department::where('faculty_id', Auth::guard('admin')->user()->faculty->id)->where('is_active', '1')->get();
        $facid =  Auth::guard('admin')->user()->faculty->id;
        if (Auth::user()->role_id == 1) {
            $departments = Department::where('is_active', '1')->get();
        }
        $list = [];
        if ($selectedDeparts) {
            //$idList = $selectedDeparts->pluck('id');            
            foreach ($selectedDeparts as $dep) {
                $list[] = $dep->id;
            }
        }
        $dataTable->setDepIds($list);

        if (($request->input('dep_id') !== NULL)) {

            $dataTable->setDepIds([$request->input('dep_id')]);
        }
        if (($request->input('licenceType') !== NULL)) {

            $licenceType = explode('?', $request->input('licenceType'))[0];  // Sanitize the licenceType input
            $dataTable->setLicenceType($licenceType);
        }
        return $dataTable->render('admin.students.recours_list', ['departments' => $departments, 'facName' => $facName]);
    }



    public function showStudentsStat()
    {
        /*
   // Fetch the statistics for each faculty
   $statistics = Student::select('faculties.name_fr as faculty_name', 'etat', DB::raw('count(*) as total'))
   ->join('faculties', 'students.faculty_id', '=', 'faculties.id')
   ->groupBy('faculty_id', 'etat')
   ->get()
   ->groupBy('faculty_name');

// Calculate the total count for each 'etat' across all faculties
$totals = Student::select('etat', DB::raw('count(*) as total'))
   ->groupBy('etat')
   ->pluck('total', 'etat');

// Fetch the total number of students for each faculty
$facultyTotals = Student::select('faculties.name_fr as faculty_name', DB::raw('count(*) as total'))
   ->join('faculties', 'students.faculty_id', '=', 'faculties.id')
   ->groupBy('faculty_id')
   ->pluck('total', 'faculty_name');
   */
        //optimazed
        // Fetch all required data in a single query
        $data = Student::select('faculties.name_fr as faculty_name', 'etat', DB::raw('count(*) as total'))
            ->join('faculties', 'students.faculty_id', '=', 'faculties.id')
            ->groupBy('faculty_id', 'etat')
            ->get();

        // Process the data to group by faculty_name and etat
        $statistics = $data->groupBy('faculty_name')->map(function ($faculty) {
            return $faculty->keyBy('etat');
        });

        // Calculate totals for each etat
        $totals = $data->groupBy('etat')->map(function ($etatGroup) {
            return $etatGroup->sum('total');
        });

        // Calculate the total number of students for each faculty
        $facultyTotals = $data->groupBy('faculty_name')->map(function ($facultyGroup) {
            return $facultyGroup->sum('total');
        });
        // Get the current date and time
        $currentDateTime = Carbon::now()->toDateTimeString();

        return view('admin.statistics.index', compact('statistics', 'totals', 'facultyTotals', 'currentDateTime'));
    }
}
