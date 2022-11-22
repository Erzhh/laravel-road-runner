<?php

namespace API\Prices\Requests;

use App\Domain\Prices\Printed\DTO\DocumentPrintedDTO;
use Core\Request\BaseRequestParams;

class DocumentPrintedRequest extends BaseRequestParams
{
    public function rules()
    {
        return [
            parent::rules(),
            'document_id'   => ['required','array'],
            'user_uid'   => ['required','uuid','exists:users,uid'],
        ];
    }

    public function getDto(): DocumentPrintedDTO
    {
        return new DocumentPrintedDTO([
            'document_id' => $this->get('document_id'),
            'user_uid' => $this->get('user_uid'),
        ]);
    }
}
