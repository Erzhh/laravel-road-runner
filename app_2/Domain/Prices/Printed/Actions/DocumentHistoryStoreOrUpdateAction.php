<?php

namespace App\Domain\Prices\Printed\Actions;

use App\Domain\Prices\Printed\DTO\DocHistoryPrintedDTO;
use App\Domain\Prices\Printed\Jobs\DocumentPrintStatusPrintingJob;
use App\Domain\Prices\Printed\Services\DocHistoryStoreService;

class DocumentHistoryStoreOrUpdateAction{

    public function __construct(
        private DocHistoryPrintedDTO $dto
    ){}

    public function run(){

        (new DocHistoryStoreService($this->dto))->run();

        //статус распечатано если вся продукция распечатано
        DocumentPrintStatusPrintingJob::dispatch($this->dto);
    }
}
