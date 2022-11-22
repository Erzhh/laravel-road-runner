<?php
namespace  Domain\Settings\CharMsg\QueryBuilder;

use App\Domain\Settings\CharMsg\Models\CharacteristicMessage;
use Illuminate\Database\Eloquent\Model;
use Core\BaseQuery;

class CharacteristicMessageQuery implements BaseQuery
{
    /**
     * @return Model
     */
    function getModel(): Model
    {
        return new CharacteristicMessage();
    }
}
