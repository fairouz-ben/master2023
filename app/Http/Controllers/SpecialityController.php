<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Validator;


class SpecialityController extends Controller
{
    public function ajax_get_specialities(Request $request)
    {
        if($request->level == 'LMD'){
            return Speciality::where(['department_id'=>$request->department,'is_active'=>1, 'is_deleted'=>0])
            ->where('level','!=','m2')
            ->get(['id','title_fr','title']);
        
        }else  if($request->level != 'LMD' )
        {
            return Speciality::where(['department_id'=>$request->department,'is_active'=>1, 'is_deleted'=>0])
            ->where('level','!=','m1')
            ->get(['id','title_fr','title']);
        }
    }
    public function index(Department $department)
    {
        $specialities = Speciality::where(['department_id'=>$department->id,
        'is_deleted'=>0])->get();
        
        return view('admin.specialities.index')->with(['specialities' => $specialities,
                                                        'department'=>$department]);
    }
    public function AllList()
    {
        $specialities = Speciality::where('is_deleted',0)->get();
        return view('admin.specialities.index')->with(['specialities' => $specialities,'department'=>'All']);
    }
    
    public function add($id){
        $department = Department::find($id);
        return view('admin.specialities.add')->with(['department'=>$department, ]);
    }
    
    public function active(Speciality $speciality)
    {
        $speciality->update([
            'is_active' => 1
        ]);
      
      flash('The speciality sussceefully active','success');
     //Flasher::addSuccess('The speciality sussceefully active');
        return back();
    }
    public function disable(Speciality $speciality)
    {
        $speciality->update([
            'is_active' => 0
        ]);
     
      flash('The speciality sussceefully disable','success');
        return back();
    }
    public function store(Request $request)
    {

        $data = $request->all();

        $validator = Validator::make($data,
            [
                "title" => ['required', 'string', 'max:255','unique:specialities,title'],
                "title_fr" => ['required', 'string', 'max:255','unique:specialities,title_fr'],
                "number_available" => ['required', 'numeric', 'min:0'],
               
            ]
        );

        if ($validator->fails()) {
            flash($validator->messages()->first(),'error');
            return back();
        }

      
        Speciality::create($request->all() );

       flash('speciality Successfully Added','success');
      
        return redirect('departments/edit/'.$request->department_id);
    }
    
    public function edit(Speciality $speciality)
    {
        
        return view('admin.specialities.edit')->with(['speciality' => $speciality]);
    }

    public function update(Speciality $speciality, Request $request)
    {
        $validator = Validator::make($request->all(),
            [
               // "title" => 'required|string|max:255|unique:specialities,title,'.$speciality->id,
                "title" => ['required', 'string', 'max:255',Rule::unique('specialities', 'title')->ignore($speciality->id)],
                "title_fr" => ['required', 'string', 'max:255',Rule::unique('specialities', 'title_fr')->ignore($speciality->id)],
                "number_available" => ['required', 'numeric', 'min:0'],
            
            ]
        );

        if ($validator->fails()) {
            flash($validator->messages()->first(),'error');
            return back();
        }
       
            $speciality->update(
                $request->all()
            );
            flash('Speciality Successfully updated','success');
           
            return back();
            //$this->index(Department::find($request->department_id));
        
    }

}
