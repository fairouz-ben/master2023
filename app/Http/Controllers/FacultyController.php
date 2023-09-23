<?php

namespace App\Http\Controllers;
use App\Models\Faculty;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    
    public function index()
    {
    
        $faculties = Faculty::all();
        return view('admin.faculties.index')->with(['faculties' => $faculties]);
    }
    public function add(){
        return view('admin.faculties.add');
    }
    public function store(Request $request)
    {

        $data = $request->all();

        $validator = Validator::make($data,
            [
                "name_ar" => ['required', 'string', 'max:255','unique:faculties,name_ar'],
                "name_fr" => ['required', 'string', 'max:255','unique:faculties,name_fr'],
                "code" => ['required', 'string', 'max:255','unique:faculties,code']
            ]
        );

        if ($validator->fails()) {
           // toastr()->error($validator->messages()->first());
            return back();
        }

        Faculty::create([
            'name_ar' => $request->name_ar,
            'name_fr' => $request->name_fr,
            'code' =>  $request->code,
        ]);
       // $flash = new ToastrFactory();
       // toastr()->success("Faculty Successfully Added");
       // $request->session()->flash('success', 'Task was successful!');
        //return redirect('faculties');
        return back();
    }
   

    public function active( Faculty $faculty)
    {
       $r= $faculty->update([
            'is_active' => 1
        ]);
       if($r)
        flash('the faculty sussceefully active','success');
        else
        flash('error in the  activation','error');
        return back();
    }
    public function disable(Faculty $faculty)
    {
       $r= $faculty->update([
            'is_active' => 0
        ]);
        if($r)
        flash('the faculty sussceefully disable','success');
        else
        flash('error when disable','error');
        return back();
       
    }

   /* public function edit( $faculty)
    {
        $fac=  Faculty::find($faculty);
        
        return view('admin.faculties.edit')->with(['faculty' => $fac]);
    }*/
   public function edit(Faculty $Faculty)
    {
        return view('admin.faculties.edit')->with(['Faculty'=>$Faculty]);
    } //error : Undefined variable $faculty

    public function update(Faculty $faculty, Request $request)
    {
        $validator = Validator::make($request->all(),
            [
         
                "name_ar" => 'required|string|max:255|unique:faculties,name_ar,'.$faculty->id,
                "name_fr" => 'required|string|max:255|unique:faculties,name_fr,'.$faculty->id,
                "code" => 'required|string|max:100|unique:faculties,code,'.$faculty->id,
               
            ]
        );

       if( $validator->fails())
       {
          
          return back()->with('error','Data not valid!');
       }
        
       $faculty->update([
        'name_ar' => $request->name_ar,
        'name_fr' => $request->name_fr,
        'code' => $request->code,
    ]);
      
        return redirect()->route('faculties')
                        ->with('success','faculty updated successfully');
       
       // else
        return back()->with('error','No updated');
        /*$faculty=  Faculty::find($faculty);
        $faculty->name_ar=$request->name_ar;
        $faculty->name_fr=$request->name_fr;
        $faculty->code=$request->code;
        $faculty->save();*/
    }
}
