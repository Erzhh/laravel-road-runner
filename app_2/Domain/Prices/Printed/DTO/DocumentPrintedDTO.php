<?php

namespace App\Domain\Prices\Printed\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class DocumentPrintedDTO extends DataTransferObject {

    public ?int  $document_id;
    public string $user_uid;
    public string $document_uid;

    public function toArray(): array
    {
        return [
            'document_id'=>$this->document_id,
            'user_uid' => $this->user_uid
        ];
    }

    public function toArrayUid():array
    {
        return [
            'document_uid'=>$this->document_uid,
            'user_uid' => $this->user_uid
        ];
    }

    public function toArrayUidPrice():array
    {
        return [
            'price_document_uid'=>$this->document_uid,
            'user_uid' => $this->user_uid
        ];
    }
}
