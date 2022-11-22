<?php
namespace App\Domain\Prices\Logotype\Services;

use App\Domain\Prices\Logotype\Models\Logotype;

class LogotypeDestroyService {

    public function __construct(
        private Logotype $logo,
    )
    {}

    public function  run(): bool
    {
        return $this->logo->delete();
    }

}
