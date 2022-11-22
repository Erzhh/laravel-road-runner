<?php

namespace Domain\Import\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class PriceDocumentImportDTO extends DataTransferObject {

    public string $name;
    public string $document_id;
    public string $document_uid;
    public string $user_uid;
    public ?string $user_name;
    public string $date;
    public array $items;

}
