<?php

namespace API\Prices\Requests;

use App\Domain\Prices\Characteristic\DTO\CharacteristicProductDTO;
use Illuminate\Foundation\Http\FormRequest;

class CharacteristicProductSettingUpdateRequest extends FormRequest
{
    public function rules():array
    {
        return [
            '*.characteristic_id' => ['required','integer'],
            '*.product_uid' => ['required','uuid'],
            '*.id' => ['required','integer' ],
            '*.order' => ['nullable','integer'],
            '*.is_visible' => ['nullable','boolean'],
            '*.is_view_text' => ['nullable','boolean'],
        ];
    }

    public function getDto():array
    {
        return CharacteristicProductDTO::arrayOf(
            $this->validated()
        );
    }
}
