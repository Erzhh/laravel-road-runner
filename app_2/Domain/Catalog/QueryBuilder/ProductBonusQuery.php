<?php
namespace  Domain\Catalog\QueryBuilder;

use Domain\Catalog\Models\ProductBonus;
use Illuminate\Database\Eloquent\Model;
use Core\BaseQuery;

class ProductBonusQuery implements BaseQuery
{
    /**
     * @return Model
     */
    function getModel(): Model
    {
        return new ProductBonus();
    }
}
