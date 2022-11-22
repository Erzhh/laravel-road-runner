<?php
namespace App\Domain\Prices\Characteristic\Services\CharacteristicValue;

use App\Domain\Prices\Characteristic\Models\CharacteristicsValue;

class  CharacteristicValueDestroyService {

    public function __construct(
        private CharacteristicsValue $value,
    )
    {}

    public function  run(): bool
    {
        return $this->value->delete();
    }

}
