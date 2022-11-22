<?php
namespace  Domain\Prices\Logotype\QueryBuilder;

use App\Domain\Prices\Logotype\Models\Logotype;
use Illuminate\Database\Eloquent\Model;
use Core\BaseQuery;

class LogotypeQuery implements BaseQuery
{
    /**
     * @return Model
     */
    function getModel(): Model
    {
        return new Logotype();
    }
}
