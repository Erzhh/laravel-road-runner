<?php

namespace App\Domain\Prices\Printed\QueryBuilder;

use App\Domain\Prices\Printed\DTO\DocumentPrintedDTO;
use Domain\Prices\Printed\QueryBuilder\DocHistoryPrintedQuery;

class DocPrintGetCountDocHistoryQuery extends DocHistoryPrintedQuery {

    public int $count = 0;
    public function __construct(
        private DocumentPrintedDTO $dto,
    ){}

    public function run()
    {
        $this->count = $this->getModel()->newQuery()
                            ->where($this->dto->toArrayUid())
                            ->count();

        return $this->count;
    }
}
