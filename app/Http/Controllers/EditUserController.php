<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Todo;
use Illuminate\Support\Facades\DB;
use Hash;

class EditUserController extends Controller
{
    public function index()
    {
            $id = $_GET['id'];
            $users = DB::table('users')->where('id',$id)
                     ->get();
            return view('editUser', ['users' => $users, 'id' => $id]);
    }

    public function edit(Request $request,$id) {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        $role = $request->input('role');
        DB::update('update users set name = ?, email = ?, password = ?, role = ? where id = ?',[$name,$email,$password,$role,$id]);
        return redirect('/admin')->with('success', 'User successfully updated.');
     }
}
