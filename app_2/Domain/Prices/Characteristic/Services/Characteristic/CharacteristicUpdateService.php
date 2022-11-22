<?php
namespace App\Domain\Prices\Characteristic\Services\Characteristic;

use App\Domain\Prices\Characteristic\DTO\CharacteristicDTO;
use App\Domain\Prices\Characteristic\Models\Characteristic;


class  CharacteristicUpdateService {

    public function __construct(
         private Characteristic $characteristic,
         private CharacteristicDTO $dto
    )
    {}

    public function  run(): bool
    {
        return $this->characteristic->update(
                                    $this->dto->toArray()
                                );
    }


}
