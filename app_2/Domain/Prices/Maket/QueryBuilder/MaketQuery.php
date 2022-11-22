<?php
namespace  Domain\Prices\Maket\QueryBuilder;

use App\Domain\Prices\Maket\Models\Maket;
use Illuminate\Database\Eloquent\Model;
use Core\BaseQuery;

class MaketQuery implements BaseQuery
{
    /**
     * @return Model
     */
    function getModel(): Model
    {
        return new Maket();
    }
}
