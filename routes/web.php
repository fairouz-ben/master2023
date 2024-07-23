<?php

use App\Http\Controllers\AppConfigController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
})->name('switchLan');  //add name to router


Route::get('/', [WelcomeController::class, 'index'])->name('/');

Route::middleware(['checkOpenDate'])->group(function () {
    Route::get('/create_account/{fac}', [RegisterController::class, 'index'])->middleware('checkOpenDate');

    Route::post('/register', [RegisterController::class, 'create'])->middleware('checkOpenDate');





    Auth::routes();
    //Auth::routes(['verify' => true]);
    // Custom login route
    Route::get('login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login')->middleware('checkOpenDate');
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


    Route::get('register', function () {
        return redirect('/'); //redirect('/create_account');
    })->name('register');
});

Route::get('/get_specialities', [SpecialityController::class, 'ajax_get_specialities'])->name('get_specialities');


//,'verified'
Route::middleware(['auth'])->group(function () {
    Route::get('/home0', [App\Http\Controllers\StudentController::class, 'index'])->name('home');
    Route::get('/student', [StudentController::class, 'index'])->name('student');
    Route::post('/student', [StudentController::class, 'store'])->name('student.store');

    Route::get('/student_home', [StudentController::class, 'studentHome'])->name('student.home');
    Route::get('/print', [StudentController::class, 'print'])->name('print');
    Route::get('/resultat_print', [StudentController::class, 'resultat_print'])->name('resultat_print');
    Route::get('/show_uploaded_file', [StudentController::class, 'show_uploaded_file'])->name('show_uploaded_file');
    Route::post('/storefile/{student}', [StudentController::class, 'update_file'])->name('storefile');

    Route::patch('/recours', [StudentController::class, 'add_recours'])->name('recours');

    Route::get('/studentEdit/{student}', [StudentController::class, 'studentEdit'])->name('studentEditProfile');
    Route::post('/studentEdit/{student}', [StudentController::class, 'UpdateStudent'])->name('studentUpdateProfile');

    //http://localhost/master-multi-guard-auth/public/storage/uploads/
    Route::get('/storage/{folder}/{file}.pdf');
});

//****Admin part**************************** */
Route::get('/admin', [LoginController::class, 'showAdminLoginForm'])->name('admin.login-view');
Route::post('/admin', [LoginController::class, 'adminLogin'])->name('admin.login');

Route::middleware(['auth:admin',])->group(function () {

    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/logout', [App\Http\Controllers\Auth\AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::middleware(['is_activeAdmin'])->group(function () {

        Route::get('/ajax_get_sp', [StudentController::class, 'ajax_get_sp']);
        Route::get('/resultat_print_admin/{id}', [StudentController::class, 'resultat_print_admin'])->name('resultat_print_admin');

        Route::post('/adminstorefile/{student}', [StudentController::class, 'update_file'])->name('adminstorefile');



        Route::get('/students/{faculty?}', [App\Http\Controllers\AdminController::class, 'list_student'])->name('students');

      

        //------------------
        Route::get('/students.pdf', [App\Http\Controllers\AdminController::class, 'generatePDF'])->name('students.pdf');


        Route::resource('list_etu', App\Http\Controllers\AdminController::class);

        Route::get('/editstudent/{student}', [StudentController::class, 'edit'])->name('student.edit');
        Route::post('/editstudent/{student}', [StudentController::class, 'UpdateStudent'])->name('student.update');



        Route::prefix('users')->group(function () {
            Route::post('/store', [App\Http\Controllers\AdminController::class, 'store'])->name('users.store');

            Route::post('/update', [App\Http\Controllers\AdminController::class, 'update'])->name('users.update');
            Route::get('/destroy/{id}/', [App\Http\Controllers\AdminController::class, 'destroy']);
            Route::get('/', [UserController::class, 'users'])->name('users.list');
            Route::get('/create', [UserController::class, 'createUser'])->name('user.create');

            Route::post('/store', [UserController::class, 'store'])->name('user.store');

            Route::post('/user_email_verified', [UserController::class, 'user_email_verified']);
        });

        Route::post('admin/student_active', [App\Http\Controllers\AdminController::class, 'student_active']);
        Route::post('admin/student_disable', [App\Http\Controllers\AdminController::class, 'student_disable']);
        Route::get('/admin/show_uploaded_file/{id}', [App\Http\Controllers\AdminController::class, 'show_uploaded_file'])->name('admin.show_uploaded_file');


        Route::post('/studentsave/{user}', [StudentController::class, 'AdminStore'])->name('admin.student.store');
        Route::post('/accept/{id}', [App\Http\Controllers\AdminController::class, 'accept']);
        Route::post('/refuse/{id}', [App\Http\Controllers\AdminController::class, 'refuse']);

        Route::get('/addstudent/{faculty}', [StudentController::class, 'create'])->name('AddStudent');

        Route::delete('student/{student}', [StudentController::class, 'deleteStudent'])->name('student.delete');

        Route::get('/deatail/{user}', [UserController::class, 'deatail'])->name('select.student');

        Route::get('/edituser/{user}', [UserController::class, 'editUser'])->name('user.edit');
        Route::post('/edituser/{user}', [UserController::class, 'update'])->name('user.update');

        Route::middleware(['check_roles:administrator,manager'])->group(function () {
            
            Route::get('/list_recours', [App\Http\Controllers\AdminController::class, 'list_recours'])->name('list.recours');

            Route::get('/etat_refus_all/{department}', [App\Http\Controllers\AdminController::class, 'etat_refus_all']);

            Route::patch('/student_update/{student}', [App\Http\Controllers\AdminController::class, 'update'])->name('student_update'); //->middleware('role_manager');
            Route::post('/department/OnOffResult/{department}', [DepartmentController::class, 'OnOffShowResult'])->name('OnOffResult');
        });

       
        
        Route::middleware(['role_supadmin:administrator'])->group(function () {
            Route::get('/admin/students/stat', [App\Http\Controllers\AdminController::class, 'showStudentsStat'])->name('admin.students.stat');

            Route::get('/admin/register', [App\Http\Controllers\Auth\AdminAuthController::class, 'showAdminRegisterForm'])->name('admin.register-view');
            Route::post('/admin/register', [App\Http\Controllers\Auth\AdminAuthController::class, 'createAdmin'])->name('admin.register');
            Route::get('/admin/list', [App\Http\Controllers\Auth\AdminAuthController::class, 'adminList'])->name('admin.list');
            Route::get('/admin/edit/{admin}', [App\Http\Controllers\Auth\AdminAuthController::class, 'showAdminEditForm'])->name('admin.edit');
            Route::post('/admin/update/{admin}', [App\Http\Controllers\Auth\AdminAuthController::class, 'updateAdmin'])->name('admin.update');

            Route::get('/appconfig', [AppConfigController::class, 'index'])->name('appconfig');
            Route::post('/appconfig/{appConfig}', [AppConfigController::class, 'update'])->name('appconfig.update');
            
            Route::delete('user/{id}', [UserController::class, 'deleteUser'])->name('users.delete');

            Route::prefix('faculties')->group(function () {
                Route::get('/', [FacultyController::class, 'index'])->name('faculties');
                Route::get('/add', [FacultyController::class, 'add']);
                Route::post('/store', [FacultyController::class, 'store']);
                Route::get('/edit/{faculty}', [FacultyController::class, 'edit']);
                Route::post('/update/{faculty}', [FacultyController::class, 'update']);
                Route::post('/disable/{faculty}', [FacultyController::class, 'disable']);
                Route::post('/active/{faculty}', [FacultyController::class, 'active']);
                Route::post('/globalconfig', [FacultyController::class, 'globalconfig'])->name('faculties.globalconfig');
                Route::post('/globalConfigShowResult', [FacultyController::class, 'globalConfigShowResult'])->name('faculties.globalConfigShowResult');
                Route::post('/globalConfigTreatment', [FacultyController::class, 'globalConfigTreatment'])->name('faculties.globalConfigTreatment');
                Route::post('/globalConfigUpdate', [FacultyController::class, 'globalConfigUpdate'])->name('faculties.globalConfigUpdate');
                Route::post('/globalConfigInscription', [FacultyController::class, 'globalConfigInscription'])->name('faculties.globalConfigInscription');
            });
            Route::prefix('departments')->group(function () {
                Route::get('/', [DepartmentController::class, 'index'])->name('departments');

                Route::get('/add', [DepartmentController::class, 'add']);
                Route::post('/store', [DepartmentController::class, 'store']);

                Route::get('/edit/{department}', [DepartmentController::class, 'edit']);
                Route::post('/update/{department}', [DepartmentController::class, 'update']);

                Route::post('/disable/{department}', [DepartmentController::class, 'disable']);
                Route::post('/active/{department}', [DepartmentController::class, 'active']);
            });
            Route::prefix('specialities')->group(function () {
                Route::get('/', [SpecialityController::class, 'AllList'])->name('listall');
                Route::get('/{department}', [SpecialityController::class, 'index'])->name('specialities');
                Route::get('/add/{department}', [SpecialityController::class, 'add'])->name('speciality.add');
                Route::post('/store', [SpecialityController::class, 'store'])->name('speciality.store');

                Route::get('/edit/{speciality}', [SpecialityController::class, 'edit'])->name('speciality.edit');

                Route::post('/update/{speciality}', [SpecialityController::class, 'update'])->name('speciality.update');

                Route::post('/disable/{speciality}', [SpecialityController::class, 'disable']);
                Route::post('/active/{speciality}', [SpecialityController::class, 'active']);
            });
            Route::get('/getnotelmd', [StudentController::class, 'calculeClassementLMD']);
            Route::get('/getnoteclass', [StudentController::class, 'calculeClassementClassique']);
            Route::get('/getnoteing', [StudentController::class, 'calculeClassementIngenieur']);


        });
    });
});
