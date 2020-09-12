<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    
    public function imageUpload(Request $request)
    {
        $res = var_export($request);
        return json_encode($res);
        $request->validate([
            'file' => [
                'required',
                'image',
                'max:2048',
                ['mimes' => ['jpeg', 'jpg', 'png']],
            ],
        ]);

        $imageName = time().'.'.$request->file->extension();
        $request->file->move(public_path('media/images'), $imageName);

        return [
            'location' => asset("media/images/$imageName")
        ];
    }

}
