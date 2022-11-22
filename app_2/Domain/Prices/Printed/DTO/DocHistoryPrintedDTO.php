<?php

namespace App\Domain\Prices\Printed\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class DocHistoryPrintedDTO extends DataTransferObject {

    public array  $products_uid;
    public string $document_uid;
    public string $user_uid;


    public function toArray(): array
    {
        $data = [];
        foreach ($this->products_uid as $products_uid){
            $data[] = [
                'history_uid' =>$products_uid,
                'document_uid' =>$this->document_uid,
                'user_uid' =>$this->user_uid,
            ];
        }
        return  $data;
    }
}
