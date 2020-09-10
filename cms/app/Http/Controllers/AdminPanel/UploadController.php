<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    
    public function imageUpload(Request $request)
    {
        $request->validate([
            'file' => 'required | image | mimes:jpeg, jpg, png | max:2048'
        ]);

        $imageName = time().'.'.$request->file->extension();
        $request->file->move(public_path('media/images'), $imageName);

        return [
            'location' => asset("media/images/$imageName")
        ];
    }

}
