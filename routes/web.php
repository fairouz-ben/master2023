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
use App\Http\Controllers\UsersController;

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


Route::get('/create_account/{fac}',[RegisterController::class,'index']);
Route::post('/register',[RegisterController::class,'create']);
Route::get('/test',[RegisterController::class,'test']);




Auth::routes();
Auth::routes(['verify' => true]);
Route::get('register', function(){
    return redirect('/create_account');
    })->name('register');


    Route::get('/get_specialities',[SpecialityController::class, 'ajax_get_specialities'])->name('get_specialities');


Route::middleware(['auth','verified'])->group( function(){
Route::get('/home0', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
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

    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/logout',[App\Http\Controllers\Auth\AdminAuthController::class,'logout'])->name('admin.logout');
    Route::get('/students', [App\Http\Controllers\AdminController::class, 'list_student'])->name('etudiant.list');
    //------------------
    Route::get('/students/{id}',[App\Http\Controllers\AdminController::class, 'list_students'])->name('listetudiants');
    Route::get('/students.pdf',[App\Http\Controllers\AdminController::class, 'generatePDF'])->name('students.pdf');

    Route::get('/datatables.data', [App\Http\Controllers\AdminController::class, 'anyData'])->name('datatables.data');
    
    Route::resource('list_etu', App\Http\Controllers\AdminController::class);
    
    Route::post('users/store', [App\Http\Controllers\AdminController::class, 'store'])->name('users.store');
    
    Route::post('users/update', [App\Http\Controllers\AdminController::class, 'update'])->name('users.update');
    Route::get('users/destroy/{id}/', [App\Http\Controllers\AdminController::class, 'destroy']);

    Route::get('/student_edit/{student}', [App\Http\Controllers\AdminController::class, 'edit'])->name('student_edit');
    Route::get('/student_details/{student}', [App\Http\Controllers\AdminController::class, 'student_details'])->name('student_details');
    
    Route::patch('/student_update/{student}',[App\Http\Controllers\AdminController::class, 'update'])->name('student_update');
    Route::post('admin/student_active', [App\Http\Controllers\AdminController::class,'student_active']);
    Route::post('admin/student_disable', [App\Http\Controllers\AdminController::class,'student_disable']);
    Route::get('/admin/show_uploaded_file/{id}',[App\Http\Controllers\AdminController::class, 'show_uploaded_file'])->name('admin.show_uploaded_file');


    Route::middleware(['role_supadmin:administrator'])->group( function()
    {
        Route::post('/accept/{id}',[App\Http\Controllers\AdminController::class, 'accept']);
        Route::post('/refuse/{id}',[App\Http\Controllers\AdminController::class, 'refuse']);
        
        Route::get('/addstudent/{faculty}',[StudentController::class, 'create'])->name('AddStudent');
        Route::get('/editstudent/{student}',[StudentController::class, 'edit'])->name('student.edit');
    });
    //------------------
    Route::middleware(['role_supadmin:administrator'])->group( function(){
        Route::get('/admin/register',[App\Http\Controllers\Auth\AdminAuthController::class,'showAdminRegisterForm'])->name('admin.register-view');
        Route::post('/admin/register',[App\Http\Controllers\Auth\AdminAuthController::class,'createAdmin'])->name('admin.register');
        
        Route::prefix('users')->group(function(){
            Route::get('/',[UsersController::class, 'users'])->name('list');
            Route::get('/edit',[UsersController::class, 'edit']);
            Route::post('/user_email_verified', [UsersController::class,'user_email_verified']);
            Route::get('/user_details/{user}', [UsersController::class, 'edit'])->name('user_details');
            
   
            
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

