<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait UploadImageTrait
{
public function UploadImage(Request $request,$folderName,$fileName){
    $image=$request->file($fileName)->getClientOriginalName();
    $path=$request->file($fileName)->storeAs($folderName,$image,'images');
    return $path;
}


}
