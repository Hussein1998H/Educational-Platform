<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait UploadVideoTrait
{
public function UploadVideo(Request $request,$folderName,$fileName){
    $video=$request->file($fileName)->getClientOriginalName();
    $path=$request->file($fileName)->storeAs($folderName,$video,'videos');
    return $path;
}


}
