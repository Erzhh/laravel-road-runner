<?php
namespace  Domain\Prices\Characteristic\QueryBuilder;

use App\Domain\Prices\Characteristic\Models\CharacteristicsProduct;
use Illuminate\Database\Eloquent\Model;
use Core\BaseQuery;

class CharacteristicProductQuery implements BaseQuery
{
    /**
     * @return Model
     */
    function getModel(): Model
    {
        return new CharacteristicsProduct();
    }
}
