<?php
namespace App\Domain\Prices\Maket\Services;

use App\Domain\Prices\Maket\DTO\MaketsDTO;
use App\Domain\Prices\Maket\Models\Maket;

class MaketUpdateService {

    public function __construct(
         private Maket $maket,
         private MaketsDTO $dto
    )
    {}

    public function  run(): bool
    {
        return $this->maket->update(
                                    $this->dto->toArray()
                                );
    }

}
