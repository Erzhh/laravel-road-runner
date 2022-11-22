<?php

namespace API\Prices\Requests;

use App\Domain\Prices\Printed\DTO\DocHistoryPrintedDTO;
use Core\Request\BaseRequestParams;

class DocHistoryPrintedRequest extends BaseRequestParams
{
    public function rules()
    {
        return [
            parent::rules(),
            'products_uid' => ['required','array','exists:products,uid'],
            'products_uid.*.' => ['uuid'],
            'document_uid'   => ['required','uuid','exists:price_documents,uid'],
            'user_uid'   => ['required','uuid','exists:users,uid'],
        ];
    }

    public function getDto()
    {
        return new DocHistoryPrintedDTO([
            'products_uid' => $this->get('products_uid'),
            'document_uid' => $this->get('document_uid'),
            'user_uid' => $this->get('user_uid'),
        ]);
    }
}
