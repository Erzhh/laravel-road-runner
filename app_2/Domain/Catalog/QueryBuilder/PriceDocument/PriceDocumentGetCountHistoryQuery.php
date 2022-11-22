<?php

namespace App\Domain\Catalog\QueryBuilder\PriceDocument;

use Domain\Catalog\Dto\PriceDocumentCountDto;
use Domain\Catalog\QueryBuilder\PriceDocumentQuery;

class PriceDocumentGetCountHistoryQuery extends PriceDocumentQuery {

    public int $count = 0;
    public function __construct(
        private PriceDocumentCountDto $dto,
    ){}

    public function run()
    {
          $this->getModel()->newQuery()
                        ->where($this->dto->toArray())
                        ->with([
                            'histories' => function ($q){
                                $this->count =  $q->count();
                            }
                        ])->first();

          return $this->count;
    }
}
