<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File_upload;

class ImageUploadController extends Controller
{
    //Add image
    public function addImage(){
        return view('add_image');
    }
    //Store image
    public function storeImage(Request $request){
        $data= new File_upload();

        if($request->file('image')){
            $file= $request->file('image');
            $filename= $file->getClientOriginalName();
            $pathinfo = pathinfo($filename, PATHINFO_EXTENSION);
            $filesize = filesize($file);
            $file-> move(public_path('/image'), $filename);
            $data['name']= $filename;
            $data['extension']= $pathinfo;
            $data['size']= $filesize;
            $data['path']= url('/image/'.$filename);
        }
        $data->save();
        return redirect()->route('viewImage');

    }
		//View image
    public function viewImage(){
        $imageData= File_upload::all();
        return view('viewImage', compact('imageData'));
    }
}
