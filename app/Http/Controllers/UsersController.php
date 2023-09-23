<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;

class UsersController extends Controller
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

    public function edit()
    {
        return 'edit';
    }
}
