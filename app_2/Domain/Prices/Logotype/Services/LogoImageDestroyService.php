<?php
namespace App\Domain\Prices\Logotype\Services;

use App\Domain\Prices\Logotype\Models\Logotype;

class LogoImageDestroyService {

    public function __construct(
        private Logotype $logo,
    )
    {}

    public function  run()
    {
        $image_path = public_path('storage/'.$this->logo->path);
        if(file_exists($image_path)){
            @unlink($image_path);
        }
    }

}
