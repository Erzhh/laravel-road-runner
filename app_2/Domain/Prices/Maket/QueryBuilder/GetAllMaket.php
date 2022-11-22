<?php
namespace Domain\Prices\Maket\QueryBuilder;

use Core\Request\DTO\RequestParamsDTO;

class GetAllMaket extends MaketQuery {

    public function __construct(
        private RequestParamsDTO $dto
    )
    {}

    public function run(): \Illuminate\Database\Eloquent\Collection|array
    {
        $query = $this->getModel()
                        ->newQuery()
                        ->when($this->dto->fields,function($q){
                            $q->select($this->dto->fields);
                        })
                        ->get();
        return $query;
    }

}
