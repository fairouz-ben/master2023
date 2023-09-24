<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use App\Models\Student;
use App\Models\Department;
use App\Models\Speciality;
use Illuminate\Http\Request;
use App\Rules\IsColumnsUnique;
use Illuminate\Validation\Rule;
use App\DataTables\UsersDataTable;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function users(UsersDataTable $dataTable)
    {

        return $dataTable->render('admin.users.users'); 
    }
   
    public function user_email_verified(Request $request) //User $user
    {
       // $user->update(['email_verified_at' =>  now()]);
        $com = User::where('id',$request->id)->update([
        'email_verified_at' => now() ]);
        
        return Response()->json($com);
       // return back();
    }

    public function editUser(User $user)
    {
        $departments= Department:: where('is_active','1')->get();
        
        
        return view('admin.users.edituser')->with(['user'=>$user,'departments'=>$departments]);
    }
    public function update(Request $request ,User $user)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'string', 'max:10',
            new IsColumnsUnique('users', ['name' => $data['name'], 'lastname' => $data['lastname'], 'birthday' => $data['birthday']],$user->id),
        ],
            'email' => ['bail','required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            //'faculty_id'=> ['integer', 'max:6'],
            'department_id'=> ['required','integer'],
            'licence_type'=> ['required', 'string'], 
        ]);
        if ($validator->fails()) {
            flash($validator->messages()->first(),'error');
            return back()->withInput();
        }
    
        $r= $user->update($request->all() );
        if ($r)
        {
            flash('Data Successfully updated','success');
            //return redirect('student');
        }
        else
        {
            flash('Data no updated!!','error');
        }
        return redirect()->route('users.list');
    
    }
    public function addUser()
    {
        $departments= Department:: where('is_active','1')->get();
        
        return view('admin.users.adduser')->with(['departments'=>$departments]);
    }

    public function deatail(User $user)
    {
        $student= Student::where(['user_id'=>$user->id])->get()->first();
        if( $student)
        {
        
            return redirect()->route('student.edit',$student->id) ; 
        }
        
        else {

            // Check if registration is allowed based on the retrieved dates
            /* //$updateEndDate = App_setting::where(['key'=>'update_end_date'])->value('value');;
            
            //$currentDate = now();
           // $updateAllowed = $currentDate <= $updateEndDate;
           // if ( $updateAllowed ){*/

            $dep= Department::where(['faculty_id'=>$user->faculty_id,'is_active'=>1])->get();
        
            $cities= City::all();
            $specialities= Speciality::where(['department_id'=>$user->department_id,'is_active'=>1, 'is_deleted'=>0])->get(['id','title_fr','title']);
            
            
            return view('student.application_form')->with(['user'=>$user,'cities'=>$cities,'specialities'=>$specialities,'departments'=>$dep]);
            // } else 
               // return view('student.close'); 
        }
    }
    public function deleteUser($id)
    {
        try {
            // Find the user by ID
            $user = User::findOrFail($id);
    
              // Check if the user is going to delete themselves
              if ($user->id === auth()->user()->id) {
                return redirect()->route('users.list')->with('error', 'You cannot delete yourself ;)');
            }
             // Check if the current user has the 'user@delete' permission
            
           /* if( !Auth::user()->hasPermission('user@delete')){
                return redirect()->route('users.list')->with('error', 'Permission denied.');
            }*/
             // Check if the user's ID is used as a foreign key in other tables
            if ($this->isUserForeignKeyInUse($user)) {
                return redirect()->route('users.list')->with('error', 'User ID is in use as a foreign key and cannot be deleted. To do that must delete his inscription first');
            }
         
    
            //delete the user
            $user->delete();
    
            return redirect()->route('users.list')->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('users.list')->with('error', 'Error deleting user: ' . $e->getMessage());
        }
    }
     // Check if the user's ID is used as a foreign key in other tables
     private function isUserForeignKeyInUse($user)
     {
         // Check each table where 'user_id' is used as a foreign key
         if (Student::where('user_id', $user->id)->exists()) {
             return true;
         }
 
         return false;
     }

}
