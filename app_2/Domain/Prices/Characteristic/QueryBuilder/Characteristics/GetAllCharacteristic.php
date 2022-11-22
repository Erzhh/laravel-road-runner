<?php
namespace App\Domain\Prices\Characteristic\QueryBuilder\Characteristics;

use Domain\Prices\Characteristic\QueryBuilder\CharacteristicQuery;
use Illuminate\Database\Eloquent\Collection;

class GetAllCharacteristic extends CharacteristicQuery {

    public function __construct(
        private array $with = []
    ){}

    public function run(): Collection
    {
        return $this->getModel()
                        ->newQuery()
                        ->with($this->with)
                        ->get();
    }

}
