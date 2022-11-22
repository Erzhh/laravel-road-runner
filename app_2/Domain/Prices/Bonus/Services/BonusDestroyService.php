<?php
namespace App\Domain\Prices\Bonus\Services;

use App\Domain\Prices\Bonus\Models\Bonus;

class  BonusDestroyService {

    public function __construct(
         private Bonus $bonus,
    )
    {}

    public function  run(): bool
    {
        return $this->bonus->delete();
    }

}
