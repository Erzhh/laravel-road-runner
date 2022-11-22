<?php

namespace API\Prices\Requests;

use App\Domain\Prices\Characteristic\DTO\CharacteristicDTO;
use Core\Request\BaseRequestParams;

class CharacteristicRequest extends BaseRequestParams
{
    public function rules()
    {
        return [
            parent::rules(),
            'property'   => ['required','string','max:255'],
            'maket_id' => ['required','integer','exists:makets,id']
        ];
    }

    public function getDto(): CharacteristicDTO
    {
        return new CharacteristicDTO([
            'property' => $this->get('property'),
            'maket_id' => $this->get('maket_id'),
        ]);
    }
}
