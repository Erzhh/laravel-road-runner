<?php

namespace API\Import\Requests;

use App\Domain\Settings\CharMsg\DTO\CharacteristicMessageDTO;
use Core\Request\BaseImportFormRequest;

class OneSImportCharacteristicRequest extends BaseImportFormRequest
{

    public function rules()
    {
        return [
            "type"=>"required|string",
            "product"   => 'required|uuid|exists:products,uid',
            "user"   => 'required|string|max:255',
            "status"   => 'required|boolean',
            "data"=>"required",
            'data.*.'   => ['string','max:255'],
        ];
    }

    public function getDto(): CharacteristicMessageDTO
    {
        return new CharacteristicMessageDTO([
            'product' => $this->input('product'),
            'user' => $this->input('user'),
            'characteristics' => $this->input('data'),
        ]);
    }

}
