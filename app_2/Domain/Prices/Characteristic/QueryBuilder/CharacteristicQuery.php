<?php
namespace  Domain\Prices\Characteristic\QueryBuilder;

use App\Domain\Prices\Characteristic\Models\Characteristic;
use Illuminate\Database\Eloquent\Model;
use Core\BaseQuery;

class CharacteristicQuery implements BaseQuery
{
    /**
     * @return Model
     */
    function getModel(): Model
    {
        return new Characteristic();
    }
}
