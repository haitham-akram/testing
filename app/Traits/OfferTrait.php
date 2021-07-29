<?php
namespace App\Traits;

Trait OfferTrait
{
    ///this is a traits
    public function saveImage($img,$folder){

        $file_extension = $img->getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $path = $folder;
        $img->move($path,$file_name);
        return $file_name;
    }
}
