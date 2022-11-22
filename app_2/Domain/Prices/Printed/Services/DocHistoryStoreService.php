<?php
namespace App\Domain\Prices\Printed\Services;

use App\Domain\Prices\Printed\DTO\DocHistoryPrintedDTO;
use Domain\Prices\Printed\QueryBuilder\DocHistoryPrintedQuery;

class DocHistoryStoreService extends DocHistoryPrintedQuery {

    public function __construct(
        private DocHistoryPrintedDTO $dto
    ){}

    public function run()
    {
        return $this->getModel()
                    ->newQuery()
                    ->upsert(
                        $this->dto->toArray(),
                        ['document_uid','history_uid','user_uid']
                    );
    }

}
