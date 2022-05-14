<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Todo;
use Illuminate\Support\Facades\DB;
use Hash;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all()->except(Auth::id());

        if(Auth::user()->role == 'Admin' ){
            return view('admin', ['users' => $users]);

        }
        else{
            return redirect('errorpage');
        }
    }

    public function store(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $role = $request->input('role');

        $data =new user;
        $data ->id;
        $data ->name = $name;
        $data ->email = $email;
        $data ->password = Hash::make($password);
        $data ->role = $role;
        $data ->save();

        return redirect('/admin')->with('success', 'User added successfully.');
    }

    public function destroy($id)
    {
        $todo = DB::table('users')->where('id',$id)
                ->get();
        DB::delete('delete from users where id = ?',[$id]);
        return redirect('/admin')->with('success', 'User successfully deleted.');
    }
}
