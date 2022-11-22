<?php
namespace  Domain\Catalog\QueryBuilder;

use Domain\Catalog\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Core\BaseQuery;

class ProductQuery implements BaseQuery
{
    /**
     * @return Model
     */
    function getModel(): Model
    {
        return new Product();
    }
}
