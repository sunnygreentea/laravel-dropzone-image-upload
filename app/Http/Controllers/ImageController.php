<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use Image;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
   
    public function index()
    {
        $images = File::allFiles(public_path('images/photos'));
        return view('photos.image', compact('images'));
    }
    

   
    public function upload(Request $request)
    {
        // Image
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $image = $request->file('image');
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('images/photos'), $imageName);

        // resize
        $imageResized = Image::make('images/photos/'.$imageName);
        $imageResized->resize(192,108);
        $imageResized->save('images/thumbnails/'.$imageName,90);
        
        return redirect ('image');
    }
    
    
    public function delete(Request $request)
    {
        if($request->get('name')) {
            File::delete(public_path('images/photos/' . $request->get('name')));
        }
    }


    
}
