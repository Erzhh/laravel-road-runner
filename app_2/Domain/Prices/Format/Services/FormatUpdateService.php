<?php
namespace App\Domain\Prices\Format\Services;

use App\Domain\Prices\Format\DTO\FormatDTO;
use App\Domain\Prices\Format\Models\Format;

class  FormatUpdateService {

    public function __construct(
         private Format $format,
         private FormatDTO $dto
    )
    {}

    public function  run(): bool
    {
        return $this->format->update(
                                    $this->dto->toArray()
                                );
    }

}
