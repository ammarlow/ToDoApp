<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Todo;
use App\Models\File_upload;
use App\Models\Todo_File_upload;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role == 'User') {
            $id = Auth::user()->id;
            $todo = DB::table('todos')->join('todo_file_upload','todo_file_upload.todo_id','=','todos.id')
                    ->join('file_uploads','file_uploads.id','=','todo_file_upload.file_upload_id')
                    ->where('user_id',$id)
                    ->get();
            return view('home', ['todo' => $todo, 'id' => $id]);
        }
        else{
            return redirect('admin');
        }
    }

    public function store(Request $request)
    {

        $user_id = Auth::user()->id;
        $message = $request->input('message');

        $data =new todo;
        $data ->id;
        $data ->message = $message;
        $data ->is_complete = "0";
        $data ->user_id = $user_id;
        $data ->save();

        $data2= new File_upload();

        if($request->file('image')){
            $file= $request->file('image');
            $filename= $file->getClientOriginalName();
            $pathinfo = pathinfo($filename, PATHINFO_EXTENSION);
            $filesize = filesize($file);
            $file-> move(public_path('/image'), $filename);
            $data2['name']= $filename;
            $data2['extension']= $pathinfo;
            $data2['size']= $filesize;
            $data2['path']= url('/image/'.$filename);
        }
        $data2->save();

        $data3 = new Todo_File_upload();
        $data3['todo_id']= $data ->id;
        $data3['file_upload_id']= $data2 ->id;
        $data3->timestamps = false;
        $data3->save();

        return redirect('/home')->with('success', 'Task added successfully.');
        return response()->json($data, 201);
    }

    public function edit(Request $request,$id) {
        $completion = $request->input('completion');

        DB::update('update todos set is_complete = ? where id = ?',[$completion,$id]);
        return redirect('/home')->with('success', 'Task successfully updated.');
        return response()->json(DB::update('update todos set is_complete = ? where id = ?',[$completion,$id]), 200);
     }

    public function destroy($id)
    {
        $todo = DB::table('todos')->where('id',$id)
                ->get();
        DB::delete('delete from todos where id = ?',[$id]);

        return redirect('/home')->with('success', 'Task successfully deleted.');
        return response()->json(null, 204);
    }
}
