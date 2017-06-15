<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function uploadFile($file, $basePath)
    {
        if($file){
            $destinationPath =public_path().$basePath;
            $fileName = rand(1, 100000).strtotime(date('Y-m-d H:i:s')).Auth::id().".".$file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            //$fileName = $destinationPath.$fileName;
            $fileName = str_replace('/../','/',$basePath).$fileName;
            return $fileName;
        }
        return null;
    }
}
