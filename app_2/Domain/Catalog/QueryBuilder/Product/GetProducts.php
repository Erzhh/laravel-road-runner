<?php

namespace Domain\Catalog\QueryBuilder\Product;

use Core\Request\DTO\RequestParamsDTO;
use Domain\Catalog\QueryBuilder\ProductQuery;

class GetProducts extends ProductQuery
{
    public function __construct(
        public $category_id,
        public RequestParamsDTO $dto
    ){}

    public function run()
    {
        $query = $this
                        ->getModel()
                        ->when($this->category_id,function ($q){
                            $q->where('category_id', $this->category_id);
                        })
                        ->when($this->dto->search,function ($q){
                            $q->where('full_name','LIKE', '%'.$this->dto->search.'%')
                              ->orWhere('full_name','LIKE', $this->dto->search);
                        })
                        ->with($this->dto->include)
                        ->paginate($this->dto->perPage);

        return $query;
    }
}
