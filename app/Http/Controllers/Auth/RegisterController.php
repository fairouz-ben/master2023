<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Admin;
use App\Models\Faculty;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Rules\IsColumnsUnique;
use Illuminate\Validation\Rule;
use App\Models\License_specialty;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::STUDENT;//HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
       // $this->middleware('guest:admin');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
  

    public function index($Faculty)
    {
        if ($Faculty != null)
        {  $fac_id=null;
            switch($Faculty){
                case 'droit':
                    $fac_id=1;
                    break;
                case 'is':
                    $fac_id=2;
                    break;
                case 'sciences':
                    $fac_id=5;
                    break;
                default:
                return back()->with('error', trans('pagination.url_error'));
            }
            $faculty=  Faculty::find($fac_id);
            if( $faculty)
            {
                if ($faculty->is_active)
           
                //when the time for inscription is still open; 
                return $this->show_register_form($faculty);
                else 
                   {     
                        flash('the registration is colsed','error');
                        return view('welcome');
                   }
            }
              //when fac  is closed you must redirct to welcome page 
            flash('Data error: ','error');
            return view('welcome');
        }    
       //when no fac , must redirct to welcome page 
        return view('welcome');
    }
    
    protected function show_register_form(Faculty $faculty)
    {
        $dep= Department::where(['faculty_id'=>$faculty->id,'is_active'=>1])->get();
        
        $dep_ids = array(); 
        foreach ($dep as $key) {
            $dep_ids[]= $key->id;
        } 
        
        $sp_l = License_specialty::whereIn('department_id', $dep_ids)->get()->toArray();
        
        
        if (!$dep->isEmpty())
        {
            
            return view('student.create_account', ['faculty'=>$faculty,'departments'=>$dep,'sp_license'=> $sp_l]);
    
        }
        flash('Data error: No Department available! ','error');
        return view('welcome');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'string', 'max:10',
            new IsColumnsUnique('users', ['name' => $data['name'], 'lastname' => $data['lastname'], 'birthday' => $data['birthday']]),
        ],
            'email' => ['bail','required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            
            'faculty_id'=> ['required','integer', 'max:6'],
            'department_id'=> ['required','integer'],
            'licence_type'=> ['required', 'string'],
        ]);
    }
    

    /**
     * 
        
        
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
       $validator= $this->validator($data); 
        
        if ($validator->fails()) {
            flash($validator->messages()->first(),'error');
            return back()->withInput();
        }
       
                
        $user = User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'birthday'=> $data['birthday'],
            'faculty_id'=> $data['faculty_id'],
            'department_id'=> $data['department_id'],
            'licence_type'=> $data['licence_type'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
       
       // return back()->with('success','Item created successfully!');
       return  $user;
       //return redirect()->route('student');
       
    }

    public function test()
    {
        $dep= Department::where(['faculty_id'=>1,'is_active'=>1])->get();
        $dep_ids = array(); 
        foreach ($dep as $key) {
            $dep_ids[]= $key->id;
        } 
       
        $sp_l = License_specialty::whereIn('department_id', $dep_ids)->get()->toArray();
      
        var_dump($sp_l);
    } 
   
    
}
