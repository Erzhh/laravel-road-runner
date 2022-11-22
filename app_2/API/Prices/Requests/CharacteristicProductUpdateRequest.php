<?php

namespace API\Prices\Requests;

use App\Domain\Prices\Characteristic\DTO\CharacteristicProductDTO;
use App\Domain\Prices\Characteristic\DTO\CharacteristicUpdateProductDTO;
use App\Domain\Prices\Characteristic\Models\CharacteristicsProduct;
use App\Domain\Prices\Characteristic\Models\CharacteristicsValue;
use Core\Request\BaseRequestParams;
use Illuminate\Validation\Rule;

class CharacteristicProductUpdateRequest extends BaseRequestParams
{
    public function rules()
    {
        $table_name = (new CharacteristicsValue())->getTable();
        return [
            parent::rules(),
            'characteristic_id' => ['nullable','integer','exists:characteristics,id'],
            'product_uid' => ['nullable','uuid','exists:products,uid'],
            'id' => ['nullable','integer',
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

    public function getDto(): CharacteristicUpdateProductDTO
    {
        return new CharacteristicUpdateProductDTO([
            'characteristic_id' => $this->get('characteristic_id'),
            'product_uid' => $this->get('product_uid'),
            'characteristic_value_id' => $this->get('id'),
            'order' => $this->get('order'),
            'is_visible' => $this->get('is_visible'),
            'is_view_text' => $this->get('is_view_text'),
        ]);
    }
}
