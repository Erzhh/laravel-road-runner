<?php

namespace API\Prices\Requests;

use App\Domain\Prices\Logotype\DTO\LogotypeDTO;
use App\Domain\Prices\Logotype\Models\Logotype;
use App\Domain\Prices\Maket\DTO\MaketsDTO;
use Core\Request\BaseFildsRequestParams;
use Core\Request\BaseRequestParams;
use Illuminate\Database\Eloquent\Model;

class LogotypeRegularRequest extends BaseFildsRequestParams
{
    public function getModel(): Model
    {
        return  new Logotype();
    }

}
