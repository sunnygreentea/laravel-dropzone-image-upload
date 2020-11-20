<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DropzoneController extends Controller
{

    public function index () {
        return view('photos.dropzone');
    }

    public function upload (Request $request) 
    {
        $image = $request->file('file');
        $imageName = time() . '-'.$image->getClientOriginalName();
        $image->move(public_path('images/dropzone'), $imageName);
        return response()->json(['success' => $imageName]);

    }

    public function fetch () {
        $images = File::allFiles(public_path('images/dropzone'));
        $output = '<div class="row">';
        foreach($images as $image)
        {
            $output .= '
            <div class="col-6 col-md-3 align-items-center text-center" >
                <img src="'.asset('images/dropzone/' . $image->getFilename()).'" class="img-thumbnail" width="192" height="108" />
                <button type="button" class="btn btn-link remove_image" id="'.$image->getFilename().'">Remove</button>
            </div>';
        }
        $output .= '</div>';
        echo $output;
    }

    public function delete(Request $request)
    {
        if($request->get('name')) {
            File::delete(public_path('images/dropzone/' . $request->get('name')));
        }
    }

    
}
