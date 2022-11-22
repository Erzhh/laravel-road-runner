<?php
namespace  Domain\Prices\Characteristic\QueryBuilder;

use App\Domain\Prices\Characteristic\Models\CharacteristicsValue;
use Illuminate\Database\Eloquent\Model;
use Core\BaseQuery;

class CharacteristicValueQuery implements BaseQuery
{
    /**
     * @return Model
     */
    function getModel(): Model
    {
        return new CharacteristicsValue();
    }
}
