<?php
namespace Domain\Prices\Logotype\QueryBuilder;

use Core\Request\DTO\RequestParamsDTO;

class GetAllLogotypes extends LogotypeQuery {

    public function __construct(
        private RequestParamsDTO $dto
    ){}

    public function run()
    {
        $query = $this->getModel()
            ->newQuery()
            ->when($this->dto->search != null,function ($q){
                $search =  $this->dto->search;
                $q->where('title','like',"%$search%")
                    ->orWhere('title','like',"$search");
            })
            ->with($this->dto->include)
            ->paginate($this->dto->perPage);

        return $query;
    }

}
