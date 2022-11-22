<?php
namespace  Domain\Prices\Printed\QueryBuilder;

use App\Domain\Prices\Printed\Models\PriceHistoryPrinted;
use Illuminate\Database\Eloquent\Model;
use Core\BaseQuery;

class DocHistoryPrintedQuery implements BaseQuery
{
    /**
     * @return Model
     */
    function getModel(): Model
    {
        return new PriceHistoryPrinted();
    }
}
