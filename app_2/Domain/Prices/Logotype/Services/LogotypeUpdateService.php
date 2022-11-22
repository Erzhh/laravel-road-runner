<?php
namespace App\Domain\Prices\Logotype\Services;

use App\Domain\Prices\Logotype\DTO\LogotypeDTO;
use App\Domain\Prices\Logotype\Models\Logotype;

class LogotypeUpdateService {

    public function __construct(
        private Logotype $logo,
        private LogotypeDTO $dto
    )
    {}

    public function  run(): bool
    {
        return $this->logo->update(
                    $this->dto->toArray()
                );
    }

}
