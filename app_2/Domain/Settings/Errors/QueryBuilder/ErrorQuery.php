<?php
namespace  Domain\Settings\Errors\QueryBuilder;

use Domain\Settings\Errors\Models\Error;
use Illuminate\Database\Eloquent\Model;
use Core\BaseQuery;

class ErrorQuery implements BaseQuery
{
    /**
     * @return Model
     */
    function getModel(): Model
    {
        return new Error();
    }
}
