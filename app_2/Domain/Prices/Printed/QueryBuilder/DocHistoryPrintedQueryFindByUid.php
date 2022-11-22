<?php

namespace App\Domain\Prices\Printed\QueryBuilder;

use App\Domain\Prices\Printed\DTO\DocHistoryPrintedDTO;
use Core\Request\DTO\RequestParamsDTO;
use Domain\Prices\Printed\QueryBuilder\DocHistoryPrintedQuery;

class DocHistoryPrintedQueryFindByUid extends DocHistoryPrintedQuery {

    public function __construct(
        private DocHistoryPrintedDTO $dto,
        private RequestParamsDTO $request = new RequestParamsDTO()
    ){}

    public function run()
    {
        return  $this->getModel()->newQuery()
                        ->whereIn('history_uid',$this->dto->products_uid)
                        ->where($this->dto->toArray())
                        ->with($this->request->include)
                        ->get();
    }
}
