<?php

namespace API\Prices\Requests;

use App\Domain\Prices\Characteristic\Models\Characteristic;
use Core\Request\BaseFildsRequestParams;
use Core\Request\BaseRequestParams;
use Illuminate\Database\Eloquent\Model;

class CharacteristicRegularRequest extends BaseFildsRequestParams
{
public function getModel(): Model
{
    return new Characteristic();
}
}
