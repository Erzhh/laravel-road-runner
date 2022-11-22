<?php
namespace App\Domain\Prices\Characteristic\Services\CharacteristicValue;

use App\Domain\Prices\Characteristic\DTO\CharacteristicValueDTO;
use App\Domain\Prices\Characteristic\DTO\CharacteristicValueUpdateDTO;
use App\Domain\Prices\Characteristic\Models\CharacteristicsValue;


class  CharacteristicValueUpdateService {

    public function __construct(
        private CharacteristicsValue $characteristic,
        private CharacteristicValueUpdateDTO $dto
    )
    {}

    public function  run(): bool
    {
        return $this->characteristic->update(
            $this->dto->toArray()
        );
    }

}
