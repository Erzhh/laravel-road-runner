<?php
namespace App\Domain\Prices\Characteristic\Services\CharacteristicProduct;

use App\Domain\Prices\Characteristic\Models\CharacteristicsProduct;

class CharacteristicProductDestroyService {

    public function __construct(
        private CharacteristicsProduct $value,
    ){}

    public function  run(): bool
    {
        return $this->value->delete();
    }

}
