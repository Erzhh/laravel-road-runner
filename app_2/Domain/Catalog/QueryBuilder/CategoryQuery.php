<?php
namespace  Domain\Catalog\QueryBuilder;

use Domain\Catalog\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Core\BaseQuery;

class CategoryQuery implements BaseQuery
{
    /**
     * @return Model
     */
    function getModel(): Model
    {
        return new Category();
    }
}
