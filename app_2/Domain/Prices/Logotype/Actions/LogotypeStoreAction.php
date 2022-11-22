<?php

namespace App\Domain\Prices\Logotype\Actions;


use App\Domain\Prices\Logotype\DTO\LogotypeDTO;
use App\Domain\Prices\Logotype\Services\LogotypeStoreService;
use App\Domain\Prices\Logotype\Services\LogoUploadService;
use DomainException;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class LogotypeStoreAction{

    public function __construct(
        private LogotypeDTO $dto,
        private object $file
    ){}

    public function run(){

        try {
            DB::beginTransaction();

            $image_name = (new LogoUploadService($this->file,'logo', $this->dto->getUploadSize() ))->run();

            $this->dto->path = $image_name;
            $logo = (new LogotypeStoreService($this->dto))->run();

            DB::commit();
        }
        catch (\DomainException $e){
            DB::rollback();
            throw new DomainException('Файл не успешно загрузилось ):');
        }

        return $logo;
    }
}
