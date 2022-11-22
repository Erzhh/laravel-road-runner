<?php
namespace App\Domain\Prices\Printed\Services;

use App\Domain\Prices\Printed\DTO\DocumentPrintedDTO;
use Domain\Prices\Printed\QueryBuilder\DocumentPrintedQuery;

class DocumentPrintStoreService extends DocumentPrintedQuery {

    public function __construct(
        private DocumentPrintedDTO $dto
    ){}

    public function run()
    {
        return $this->getModel()
            ->newQuery()
            ->upsert(
                $this->dto->toArrayUidPrice(),
                ['price_document_uid','user_uid']
            );
    }

}
