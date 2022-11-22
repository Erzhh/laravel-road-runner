<?php
namespace  Domain\Catalog\QueryBuilder;

use Domain\Catalog\Models\PriceType;
use Illuminate\Database\Eloquent\Model;
use Core\BaseQuery;

class PriceTypeQuery implements BaseQuery
{
    /**
     * @return Model
     */
    function getModel(): Model
    {
        return new PriceType();
    }
}
