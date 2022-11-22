<?php
namespace Domain\Prices\Maket\QueryBuilder;

use Core\Request\DTO\RequestParamsDTO;

class GetAllPaginateMaket extends MaketQuery {

    public function __construct(
        private RequestParamsDTO $dto
    )
    {}

    public function run()
    {
        $query = $this->getModel()
                        ->newQuery()
                        ->when($this->dto->fields,function($q){
                            $q->select($this->dto->fields);
                        })
                        ->when($this->dto->search != null,function ($q){
                            $search =  $this->dto->search;
                              $q->where('title','like',"%$search%")
                                ->orWhere('title','like',"$search");
                        })
                        ->paginate($this->dto->perPage);
        return $query;
    }

}
