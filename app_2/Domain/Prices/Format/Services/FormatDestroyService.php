<?php
namespace App\Domain\Prices\Format\Services;

use App\Domain\Prices\Format\Models\Format;

class  FormatDestroyService {

    public function __construct(
         private Format $format,
    )
    {}

    public function  run(): bool
    {
        return $this->format->delete();
    }

}
