<?php
namespace  Domain\Prices\Bonus\QueryBuilder;

use App\Domain\Prices\Bonus\Models\Bonus;
use Illuminate\Database\Eloquent\Model;
use Core\BaseQuery;

class BonusQuery implements BaseQuery
{
    /**
     * @return Model
     */
    function getModel(): Model
    {
        return new Bonus();
    }
}
