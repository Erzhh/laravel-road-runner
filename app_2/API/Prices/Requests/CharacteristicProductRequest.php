<?php

namespace API\Prices\Requests;

use App\Domain\Prices\Characteristic\DTO\CharacteristicProductDTO;
use App\Domain\Prices\Characteristic\Models\CharacteristicsValue;
use Core\Request\BaseRequestParams;
use Illuminate\Validation\Rule;

class CharacteristicProductRequest extends BaseRequestParams
{
    public function rules()
    {
        $table_name = (new CharacteristicsValue())->getTable();
        return [
            parent::rules(),
            'characteristic_id' => ['required','integer','exists:characteristics,id'],
            'product_uid' => ['required','uuid','exists:products,uid'],
            'id' => ['required','integer',//value_id
                Rule::exists($table_name)->where(function ($query) {
                    $query->where([
                                    'characteristic_id'=> $this->get('characteristic_id')
                                ]);
                })
            ],
            'order' => ['nullable','integer'],
            'is_visible' => ['nullable','boolean'],
            'is_view_text' => ['nullable','boolean'],
        ];
    }

    public function getDto(): CharacteristicProductDTO
    {
        return new CharacteristicProductDTO([
            'characteristic_id' => $this->get('characteristic_id'),
            'product_uid' => $this->get('product_uid'),
            'characteristic_value_id' => $this->get('id'),
            'order' => $this->get('order'),
            'is_visible' => $this->get('is_visible'),
            'is_view_text' => $this->get('is_view_text'),
        ]);
    }
}
