<?php

namespace Domain\Catalog\QueryBuilder\Product;

use Core\Request\DTO\RequestParamsDTO;
use Domain\Catalog\QueryBuilder\ProductQuery;

class GetAllProducts extends ProductQuery
{

    public function __construct(
        private RequestParamsDTO $dto = new RequestParamsDTO()
    )
    {}

    public function run()
    {
        $query = $this
                        ->getModel()
                        ->newQuery()
                        ->when($this->dto->fields,function ($q){
                            $q->select($this->dto->fields);
                        })
                        ->get();

        return $query;
    }
}
