<?php

namespace API\Prices\Resources;

use App\Domain\Prices\Format\Models\Format;
use App\Domain\Prices\Maket\Models\Maket;
use Core\Resources\BaseFildsJsonResource;
use Illuminate\Database\Eloquent\Model;

class MaketResources extends BaseFildsJsonResource
{
    function getModel(): Model{
        return  new Maket();
    }
    protected string $type = 'makets';
}
