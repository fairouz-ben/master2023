<?php

namespace App\Http\Controllers\Auth;
//use Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AdminCustomerRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminAuthController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Handle an incoming admin authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
   /* public function __construct()
    {
       // $this->middleware('guest');
        $this->middleware('guest:admin');
    }*/
    public function showAdminLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        } else {
            return  view('auth.login', ['route' => route('admin.login-view'), 'title'=>'Admin']);
        }
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt($request->only('email','password'), $request->get('remember'))){
            return redirect()->intended('/admin/dashboard');
        }
        //return redirect()->back()->withError('Credentials doesn\'t match.');

        return back()->withInput($request->only('email', 'remember'));
    }

    
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function showAdminRegisterForm()
    {
        if( Auth::guard('admin')->user()->role_id == 1)
        {
            return view('auth.register', ['route' => route('admin.register-view'), 'title'=>'Sup Admin']);
 
        }
        return redirect()->back();
    }
  
    protected function createAdmin(AdminCustomerRequest  $request) //Request
    {
       // $this->validatorAdmin($request->all())->validate();

       //$request->validated(); ///try it later
        $admin = Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
           
            'faculty_id' => $request['faculty_id'],
            'role_id' => $request['role_id'],
        ]);
        return redirect()->intended('admin');
    }
}
