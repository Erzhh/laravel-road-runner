<?php
namespace  Domain\Catalog\QueryBuilder;

use Domain\Catalog\Models\PriceDocument;
use Domain\Catalog\Models\PriceHistory;
use Illuminate\Database\Eloquent\Model;
use Core\BaseQuery;

class PriceHistoriesQuery implements BaseQuery
{
    /**
     * @return Model
     */
    function getModel(): Model
    {
        return new PriceHistory();
    }
}
