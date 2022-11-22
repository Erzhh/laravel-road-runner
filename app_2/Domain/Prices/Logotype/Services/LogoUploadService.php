<?php
namespace App\Domain\Prices\Logotype\Services;

use App\Domain\Prices\Logotype\DTO\LogotypeDTO;
use App\Domain\Prices\Logotype\Models\Logotype;
use Intervention\Image\Facades\Image;

class LogoUploadService {

    public function __construct(
        private object $file,
        private string $folder,
        private array $size = [300,300]
    ){}

    public function  run(): string
    {
        $image = $this->file;
        $folder = public_path('storage/');

        $image_name = $this->folder.'/'.time().$image->getClientOriginalName();

        $img = Image::make($image->getRealPath());
        $img->resize($this->size[0], $this->size[1], function ($constraint) {
            $constraint->aspectRatio();
        })->save($folder.$image_name);

        return $image_name;
    }

}
