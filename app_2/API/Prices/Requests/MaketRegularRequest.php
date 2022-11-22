<?php

namespace API\Prices\Requests;

use App\Domain\Prices\Maket\Models\Maket;
use Core\Request\BaseFildsRequestParams;
use Illuminate\Database\Eloquent\Model;

class MaketRegularRequest extends BaseFildsRequestParams
{
    public function getModel(): Model
    {
        return  new Maket();
    }



}
