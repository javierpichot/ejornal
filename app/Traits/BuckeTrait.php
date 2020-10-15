<?php namespace App\Traits;

use Illuminate\Support\Facades\Storage;


/**
 *
 */
trait BuckeTrait
{
    private function uploaded($request,$key)
    {
        return $path = Storage::putFile('public/'.$this->getBucket($request), $request->file($key));
    }

    private function getPath($request)
    {
        return $storage_path = storage_path('app/public/'.$this->getBucket($request));
    }

    private function getBucket($request)
    {
        if($request->hasFile('empresa')){
            return 'empresa';
        }
        if($request->hasFile('photo')){
           return  'photos';
        }
    }
}
