<?php

namespace API\Prices\Requests;

use App\Domain\Prices\Characteristic\Models\CharacteristicsProduct;
use Core\Request\BaseFildsRequestParams;
use Illuminate\Database\Eloquent\Model;

class CharacteristicProductRegularRequest extends BaseFildsRequestParams
{
    public function getModel(): Model
    {
        return new CharacteristicsProduct();
    }
}
