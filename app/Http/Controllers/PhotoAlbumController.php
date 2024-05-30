<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoAlbumController extends Controller
{
    public function upload(Request $request){
        $file = $request->file('image');
        $file_ext = $file->getClientOriginalExtension();
        $file->move('storage/img', time().'.'.$file_ext);
        return 'ok';
    }

    public function getAllFiles(Request $request){
        $fileOriginal = Storage::allFiles('public/img');
        $files = [];
        foreach ($fileOriginal as $key => $value) {
            $files[] = $request->root().'/storage'.substr($value,6,strlen($value)-6);
        }
        return response ($files);
    }
}
