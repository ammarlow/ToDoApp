<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Todo;
use Illuminate\Support\Facades\DB;

class EditTaskController extends Controller
{
    public function index()
    {
            $id = $_GET['id'];
            $todo = DB::table('todos')->where('id',$id)
                     ->get();
            return view('editTask', ['todo' => $todo, 'id' => $id]);
    }

    public function edit(Request $request,$id) {
        $message = $request->input('message');
        DB::update('update todos set message = ? where id = ?',[$message,$id]);
        return redirect('/home')->with('success', 'Task successfully updated.');
     }
}
