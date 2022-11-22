<?php

namespace API\Import\Requests;

use API\Import\Requests\Attributes\OneSImportPriceDocumentAttributes;
use Core\Request\BaseImportFormRequest;
use Domain\Import\DTO\PriceDocumentImportDTO;
use Domain\Import\DTO\PriceDocumentItemImportDTO;

class OnesImportPriceDocumentRequest extends BaseImportFormRequest
{
    use OneSImportPriceDocumentAttributes;

    public function rules()
    {
        return [
            "data"=>"required",
            "data.document"   => 'required|string|max:255',
            "data.document_id"   => 'required',
            'data.date'  => 'required|date',
//            'user_uid'   => ['required','uuid','exists:users,uid'],
            'data.user_uid'   => ['required','uuid'],
            'data.user_name'   => ['nullable','string','max:255'],
            'data.items'   => ['required','array'],
            'data.items.*.product'   => ['required','uuid'],
            'data.items.*.cost_type'   => ['required','uuid'],
            'data.items.*.cost'   => ['required','integer'],
        ];
    }

    public function getDto(){
        return new PriceDocumentImportDTO([
            'name'          => $this->input('data.document'),
            'document_id'   => $this->input('data.document_id'),
            'document_uid'  => $this->input('data.document_uid'),
            'user_uid'      => $this->input('data.user_uid'),
            'user_name'      => $this->input('data.user_name'),
            'date'          => $this->input('data.date'),
            'items'         => PriceDocumentItemImportDTO::arrayOf( $this->input('data.items') ),
        ]);
    }

}
