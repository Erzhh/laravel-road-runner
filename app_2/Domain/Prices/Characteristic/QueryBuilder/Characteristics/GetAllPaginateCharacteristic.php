<?php
namespace App\Domain\Prices\Characteristic\QueryBuilder\Characteristics;

use Core\Request\DTO\RequestParamsDTO;
use Domain\Prices\Characteristic\QueryBuilder\CharacteristicQuery;

class GetAllPaginateCharacteristic extends CharacteristicQuery {

    public function __construct(
        private RequestParamsDTO $dto
    ){}

    public function run()
    {
        $query = $this->getModel()
                        ->when($this->dto->search != null,function ($q){
                            $search =  '%' . $this->dto->search . '%';
                            $q->where('property','like',"%$search%")
                              ->orWhere('property','like',"%$search%");
                        })
                        ->with($this->dto->include)
                        ->paginate($this->dto->perPage);

        return $query;
    }

}
