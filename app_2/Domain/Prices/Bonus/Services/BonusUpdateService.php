<?php
namespace App\Domain\Prices\Bonus\Services;

use App\Domain\Prices\Bonus\DTO\BonusDTO;
use App\Domain\Prices\Bonus\Models\Bonus;

class BonusUpdateService {

    public function __construct(
         private Bonus $bonus,
         private BonusDTO $dto
    )
    {}

    public function  run(): bool
    {
        return $this->bonus->update(
                                    $this->dto->toArray()
                                );
    }

}
