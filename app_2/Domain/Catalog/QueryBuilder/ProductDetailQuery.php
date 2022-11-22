<?php
namespace  Domain\Catalog\QueryBuilder;

use Domain\Catalog\Models\ProductDetail;
use Illuminate\Database\Eloquent\Model;
use Core\BaseQuery;

class ProductDetailQuery implements BaseQuery
{
    /**
     * @return Model
     */
    function getModel(): Model
    {
        return new ProductDetail();
    }
}
