<?php

namespace App\Http\Controllers;
use App\Models\Faculty;
use App\Models\Department;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    
    public function index()
    {
        $departments = Department::all();
        return view('admin.departments.index')->with(['departments' => $departments]);
    }
    public function add(){
        $faculties = Faculty::all();
        return view('admin.departments.add')->with(['faculties'=>$faculties]);
    }
    public function active(Department $department)
    {
        $department->update([
            'is_active' => 1
        ]);
      
      flash('The department sussceefully active','success');
     // Flasher::addSuccess('The department sussceefully active');
        return back();
    }
    public function disable(Department $department)
    {
        $department->update([
            'is_active' => 0
        ]);
      // toastr('The department sussceefully disable',NotificationInterface::SUCCESS,'department');//work good alos
       
      flash('The department sussceefully disable','success');
        return back();
    }
    public function store(Request $request)
    {

        $data = $request->all();

        $validator = Validator::make($data,
            [
                "name_fr" => ['required', 'string', 'max:255','unique:departments,name_fr'],
                "name_ar" => ['required', 'string', 'max:255','unique:departments,name_ar'],
                "code" => [ 'string', 'max:20'],
                "faculty_id" => ['required','exists:faculties,id']//
            
            ]
        );

        if ($validator->fails()) {
            flash($validator->messages()->first(),'error');
            return back();
        }

      
        Department::create($request->all() );

        flash('Department Successfully Added','success');
       // return redirect('departments');
        return back();
    }
    public function edit(Department $department)
    {
        $faculties =Faculty::all();
        return view('admin.departments.edit')->with(['department' => $department,'faculties'=>$faculties]);
    }

    public function update(Department $department, Request $request)
    {
        $validator = Validator::make($request->all(),
            [
               "name_fr" => 'required|string|max:255|'.Rule::unique('departments', 'name_fr')->ignore($department->id),
               // 'name_fr' => ['string','max:255','required', Rule::unique('departments')->ignore($department->id)],
               "name_ar" => 'required|string|max:255|'.Rule::unique('departments')->ignore($department->id),
               
                "code" => [ 'string', 'max:20'],
                "speciality_max_choice" => [ 'numeric', 'min_digits:1','max:10'],
                "faculty_id" => ['required','exists:faculties,id']
            
            ]
        );

        if ($validator->fails()) {
            flash($validator->messages()->first(),'error');
            return back();
        }
       $r= $department->update(
            $request->all()
        );
        if ($r)
        {
            flash('Department Successfully updated','success');
            //return redirect('departments');
        }
        else
        {
            flash('Department no updated!!','error');
       
        }
        return back();

       
       
    }
}
