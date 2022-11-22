<?php

namespace App\Domain\Prices\Logotype\Actions;

use App\Domain\Prices\Logotype\DTO\LogotypeDTO;
use App\Domain\Prices\Logotype\Models\Logotype;
use App\Domain\Prices\Logotype\Services\LogoImageDestroyService;
use App\Domain\Prices\Logotype\Services\LogotypeUpdateService;
use App\Domain\Prices\Logotype\Services\LogoUploadService;
use DomainException;
use Illuminate\Support\Facades\DB;

class LogotypeUpdateAction{

    public function __construct(
        private Logotype $logo,
        private LogotypeDTO $dto,
        private ?object $file
    )
    {}

    public function run(){
        try {
            DB::beginTransaction();

            if($this->file){
                (new LogoImageDestroyService($this->logo))->run();

                $image_name = (new LogoUploadService(file:$this->file,folder:'logo',size:$this->dto->getUploadSize()))->run();
                $this->dto->path = $image_name;
            }else{
                $this->dto->path = $this->logo->path;
            }

            (new LogotypeUpdateService($this->logo,$this->dto))->run();

            DB::commit();
        }
        catch (\DomainException $e){
            DB::rollback();
            throw new DomainException('Файл не успешно загрузилось ):');
        }

    }
}
