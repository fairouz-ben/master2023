<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('locale/{locale}',function($locale){
    Session::put('locale',$locale);    
    return redirect()->back();
})->name('switchLan');  //add name to router

Route::get('/', function () {
    return view('welcome');
});


//Route::get('/create_account/{fac}',[RegisterController::class,'index']);
Route::post('/register',[RegisterController::class,'create']);
Route::get('/getnotelmd',[StudentController::class,'calculeClassementLMD']);




//Auth::routes();
Auth::routes(['verify' => true]);
// Custom login route
Route::get('login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'App\Http\Controllers\Auth\LoginController@login');

// Custom logout route
Route::post('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
// Display the password reset request form
Route::get('password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');

// Handle the submission of the password reset request form
Route::post('password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

// Display the password reset form
Route::get('password/reset/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');

// Handle the submission of the password reset form
Route::post('password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset')->name('password.update');


Route::get('register', function(){
    return redirect('/'); //redirect('/create_account');
    })->name('register');


    Route::get('/get_specialities',[SpecialityController::class, 'ajax_get_specialities'])->name('get_specialities');


Route::middleware(['auth','verified'])->group( function(){
Route::get('/home0', [App\Http\Controllers\StudentController::class, 'index'])->name('home');
Route::get('/student', [StudentController::class, 'index'])->name('student');
Route::post('/student', [StudentController::class, 'store'])->name('student.store');
Route::get('/student_home', [StudentController::class, 'studentHome'])->name('student.home');
Route::get('/print',[StudentController::class, 'print'])->name('print');
Route::get('/show_uploaded_file',[StudentController::class, 'show_uploaded_file'])->name('show_uploaded_file');
Route::post('/storefile/{student}',[StudentController::class, 'update_file'])->name('storefile');
   

//http://localhost/master-multi-guard-auth/public/storage/uploads/
Route::get('/storage/{folder}/{file}.pdf');

});

//****Admin part**************************** */
Route::get('/admin',[LoginController::class,'showAdminLoginForm'])->name('admin.login-view');
Route::post('/admin',[LoginController::class,'adminLogin'])->name('admin.login');

Route::middleware(['auth:admin'])->group( function(){

    Route::post('/adminstorefile/{student}',[StudentController::class, 'update_file'])->name('admin.storefile');
   


    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/logout',[App\Http\Controllers\Auth\AdminAuthController::class,'logout'])->name('admin.logout');
    Route::get('/students', [App\Http\Controllers\AdminController::class, 'list_student'])->name('students');
    //------------------
   Route::get('/students.pdf',[App\Http\Controllers\AdminController::class, 'generatePDF'])->name('students.pdf');

   
    Route::resource('list_etu', App\Http\Controllers\AdminController::class);
    
    Route::get('/editstudent/{student}',[StudentController::class, 'edit'])->name('student.edit');
    Route::post('/editstudent/{student}', [StudentController::class, 'UpdateStudent'])->name('student.update');
    
    Route::post('users/store', [App\Http\Controllers\AdminController::class, 'store'])->name('users.store');
    
    Route::post('users/update', [App\Http\Controllers\AdminController::class, 'update'])->name('users.update');
    Route::get('users/destroy/{id}/', [App\Http\Controllers\AdminController::class, 'destroy']);

  
    Route::patch('/student_update/{student}',[App\Http\Controllers\AdminController::class, 'update'])->name('student_update');
    Route::post('admin/student_active', [App\Http\Controllers\AdminController::class,'student_active']);
    Route::post('admin/student_disable', [App\Http\Controllers\AdminController::class,'student_disable']);
    Route::get('/admin/show_uploaded_file/{id}',[App\Http\Controllers\AdminController::class, 'show_uploaded_file'])->name('admin.show_uploaded_file');


    Route::middleware(['role_supadmin:administrator'])->group( function()
    {
        Route::post('/accept/{id}',[App\Http\Controllers\AdminController::class, 'accept']);
        Route::post('/refuse/{id}',[App\Http\Controllers\AdminController::class, 'refuse']);
        
        Route::get('/addstudent/{faculty}',[StudentController::class, 'create'])->name('AddStudent');
       
        Route::delete('student/{student}', [StudentController::class, 'deleteStudent'])->name('student.delete');
             
        Route::get('/edituser/{user}',[UserController::class, 'editUser'])->name('user.edit');
        Route::post('/edituser/{user}',[UserController::class, 'update'])->name('user.update');

        Route::get('/deatail/{user}',[UserController::class, 'deatail'])->name('select.student');
          
        
        Route::delete('user/{id}', [UserController::class, 'deleteUser'])->name('users.delete');

    });
    //------------------
    Route::middleware(['role_supadmin:administrator'])->group( function(){
        Route::get('/admin/register',[App\Http\Controllers\Auth\AdminAuthController::class,'showAdminRegisterForm'])->name('admin.register-view');
        Route::post('/admin/register',[App\Http\Controllers\Auth\AdminAuthController::class,'createAdmin'])->name('admin.register');
        
        Route::prefix('users')->group(function(){
            Route::get('/',[UserController::class, 'users'])->name('users.list');

            Route::post('/user_email_verified', [UserController::class,'user_email_verified']);
         
   
            
        });
        Route::prefix('faculties')->group(function(){
            Route::get('/',[FacultyController::class, 'index'])->name('faculties');
            Route::get('/add',[FacultyController::class, 'add']);
            Route::post('/store',[FacultyController::class, 'store']);
            Route::get('/edit/{faculty}',[FacultyController::class, 'edit']);
            Route::post('/update/{faculty}',[FacultyController::class, 'update']);
            Route::post('/disable/{faculty}',[FacultyController::class, 'disable']);
            Route::post('/active/{faculty}',[FacultyController::class, 'active']);
        });
        Route::prefix('departments')->group(function(){
            Route::get('/',[DepartmentController::class, 'index'])->name('departments');
    
            Route::get('/add',[DepartmentController::class, 'add']);
            Route::post('/store',[DepartmentController::class, 'store']);
    
            Route::get('/edit/{department}',[DepartmentController::class, 'edit']);
            Route::post('/update/{department}',[DepartmentController::class, 'update']);
    
            Route::post('/disable/{department}',[DepartmentController::class, 'disable']);
            Route::post('/active/{department}',[DepartmentController::class, 'active']);
        });
        Route::prefix('specialities')->group(function(){
            Route::get('/',[SpecialityController::class, 'AllList'])->name('listall');
            Route::get('/{department}',[SpecialityController::class, 'index'])->name('specialities');
            Route::get('/add/{department}',[SpecialityController::class, 'add'])->name('speciality.add');
            Route::post('/store',[SpecialityController::class, 'store'])->name('speciality.store');
    
            Route::get('/edit/{speciality}',[SpecialityController::class, 'edit'])->name('speciality.edit');
    
            Route::post('/update/{speciality}',[SpecialityController::class, 'update'])->name('speciality.update');
    
            Route::post('/disable/{speciality}',[SpecialityController::class, 'disable']);
            Route::post('/active/{speciality}',[SpecialityController::class, 'active']);
        });
        
    });
});

