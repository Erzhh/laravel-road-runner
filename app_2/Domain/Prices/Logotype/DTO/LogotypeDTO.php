<?php

namespace App\Domain\Prices\Logotype\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class LogotypeDTO extends DataTransferObject {

    public string $title;
    public string|null $path;
    private array $size = [300,300];

    public function getUploadSize(): array
    {
        return $this->size;
    }
}
