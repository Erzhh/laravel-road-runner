<?php

namespace API\Prices\Requests;

use App\Domain\Prices\Characteristic\DTO\CharacteristicValueUpdateDTO;
use Core\Request\BaseRequestParams;

class CharacteristicValueUpdateRequest extends BaseRequestParams
{
    public function rules()
    {
        return [
            parent::rules(),
            'title'   => ['required','string'],
            'characteristic_id' => ['nullable','integer','exists:characteristics,id']
        ];
    }

    public function getDto(): CharacteristicValueUpdateDTO
    {
        return new CharacteristicValueUpdateDTO([
            'title' => $this->get('title'),
            'characteristic_id' => $this->get('characteristic_id'),
        ]);
    }
}
