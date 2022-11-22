<?php
namespace App\Domain\Prices\Characteristic\Services\Characteristic;

use App\Domain\Prices\Characteristic\Models\Characteristic;

class  CharacteristicDestroyService {

    public function __construct(
         private Characteristic $characteristic,
    )
    {}

    public function  run(): bool
    {
        return $this->characteristic->delete();
    }

}
