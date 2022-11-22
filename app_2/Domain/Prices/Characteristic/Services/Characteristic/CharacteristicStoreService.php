<?php
namespace App\Domain\Prices\Characteristic\Services\Characteristic;

use App\Domain\Prices\Characteristic\DTO\CharacteristicDTO;
use Domain\Prices\Characteristic\QueryBuilder\CharacteristicQuery;
use Illuminate\Database\Eloquent\Model;

class CharacteristicStoreService extends CharacteristicQuery {

    public function __construct(
        private CharacteristicDTO $dto
    )
    {}

    public function run(): Model
    {
        return $this->getModel()
            ->newQuery()
            ->create(
                $this->dto->toArray()
            );
    }

}
