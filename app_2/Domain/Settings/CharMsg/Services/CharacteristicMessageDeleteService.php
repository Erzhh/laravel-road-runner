<?php
namespace App\Domain\Settings\CharMsg\Services;

use Domain\Settings\CharMsg\QueryBuilder\CharacteristicMessageQuery;

class CharacteristicMessageDeleteService extends CharacteristicMessageQuery {

    public function __construct(
        private int $id
    ){}

    public function run()
    {
        return $this->getModel()
                    ->newQuery()
                    ->find($this->id)
                    ->delete();
    }

}
