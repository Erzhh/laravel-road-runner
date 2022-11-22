<?php

namespace Domain\Catalog\Dto;

use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class PriceDocumentCountDto extends  DataTransferObject {

    public string $document_uid;

    public function toArray(): array
    {
        return [
            'uid'=>$this->document_uid,
        ];
    }

}
