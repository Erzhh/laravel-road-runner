<?php

namespace Domain\Settings\Errors\QueryBuilder;

use Core\Request\DTO\RequestParamsDTO;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetAllPaginateErrorQuery extends ErrorQuery
{

    public function __construct(
        private RequestParamsDTO $dto = new RequestParamsDTO()
    ){}

    public function run(): LengthAwarePaginator
    {
        $query = $this->getModel()
                        ->newQuery()
                        ->with($this->dto->include)
                        ->when($this->dto->fields,function ($q){
                            $q->select($this->dto->fields);
                        })
                        ->orderBy('id','desc')
                        ->paginate($this->dto->perPage);

        return $query;
    }
}
