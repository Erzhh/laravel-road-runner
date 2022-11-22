<?php

namespace API\Prices\Requests;

use App\Domain\Prices\Characteristic\DTO\CharacteristicValueDTO;
use Core\Request\BaseRequestParams;

class CharacteristicValueRequest extends BaseRequestParams
{
    public function rules()
    {
        return [
            parent::rules(),
            'titles'   => ['required','array'],
            'titles.*.'   => ['string','integer','max:255'],
            'characteristic_id' => ['nullable','integer','exists:characteristics,id']
        ];
    }

    public function getDto(): CharacteristicValueDTO
    {
        return new CharacteristicValueDTO([
            'titles' => $this->get('titles'),
            'characteristic_id' => $this->get('characteristic_id'),
        ]);
    }
}
