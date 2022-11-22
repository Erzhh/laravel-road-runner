<?php
namespace App\Domain\Prices\Characteristic\Services\CharacteristicProduct;

use App\Domain\Prices\Characteristic\DTO\CharacteristicProductDTO;
use Domain\Prices\Characteristic\QueryBuilder\CharacteristicProductQuery;
use Illuminate\Database\Eloquent\Model;

class CharacteristicProductStoreService extends CharacteristicProductQuery {

    public function __construct(
        private CharacteristicProductDTO $dto
    )
    {}

    public function run(): Model
    {
        return $this->getModel()
            ->newQuery()
            ->updateOrCreate(
                ['characteristic_id'=> $this->dto->characteristic_id, 'product_uid'=> $this->dto->product_uid],
                $this->dto->toArray()
            );
    }

}
