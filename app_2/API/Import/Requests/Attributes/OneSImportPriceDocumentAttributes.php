<?php
namespace API\Import\Requests\Attributes;

trait OneSImportPriceDocumentAttributes{

    public function attributes(){
        return  [
            'data.document' => 'документ',
            'data.document_id' => 'uid документа',
            'data.date' => 'время',
            'data.items' => 'список продуктов',
            'data.user_uid' => 'uid пользователя',
        ];
    }
}
