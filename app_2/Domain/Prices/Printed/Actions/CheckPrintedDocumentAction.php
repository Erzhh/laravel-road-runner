<?php

namespace App\Domain\Prices\Printed\Actions;

use App\Domain\Catalog\QueryBuilder\PriceDocument\PriceDocumentGetCountHistoryQuery;
use App\Domain\Prices\Printed\DTO\DocumentPrintedDTO;
use App\Domain\Prices\Printed\QueryBuilder\DocPrintGetCountDocHistoryQuery;
use App\Domain\Prices\Printed\Services\DocumentPrintStoreService;
use Domain\Catalog\Dto\PriceDocumentCountDto;

class CheckPrintedDocumentAction{

    public function __construct(
        private DocumentPrintedDTO $dto
    ){}

    public function run(){

        $document_print_dto_count = (new DocPrintGetCountDocHistoryQuery($this->dto))->run();

        $price_document_dto =  new PriceDocumentCountDto([
            'document_uid' => $this->dto->document_uid,
        ]);
        $price_document_count = (new PriceDocumentGetCountHistoryQuery($price_document_dto))->run();

        if($price_document_count <= $document_print_dto_count) {
            (new DocumentPrintStoreService($this->dto))->run();
        }

    }
}
