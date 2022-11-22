<?php

namespace App\Domain\Prices\Printed\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class DocumentUidForJobDto extends DataTransferObject {

    public string $document_uid;

    public function toArray(): array
    {
        return [
            'document_uid'=>$this->document_uid,
        ];
    }
}
