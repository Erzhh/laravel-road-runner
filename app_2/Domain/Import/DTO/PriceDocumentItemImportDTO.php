<?php

namespace Domain\Import\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class PriceDocumentItemImportDTO extends DataTransferObject {

    public string $product;
    public string $cost_type;
    public int $cost;

}
