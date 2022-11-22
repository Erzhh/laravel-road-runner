<?php
namespace  Domain\Prices\Format\QueryBuilder;

use App\Domain\Prices\Format\Models\Format;
use Illuminate\Database\Eloquent\Model;
use Core\BaseQuery;

class FormatQuery implements BaseQuery
{
    /**
     * @return Model
     */
    function getModel(): Model
    {
        return new Format();
    }
}
