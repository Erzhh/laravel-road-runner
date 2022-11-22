<?php
namespace App\Domain\Prices\Characteristic\Services\CharacteristicValue;

use App\Domain\Prices\Characteristic\DTO\CharacteristicValueDTO;
use Domain\Prices\Characteristic\QueryBuilder\CharacteristicValueQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CharacteristicValueStoreService extends CharacteristicValueQuery {

    public function __construct(
        private CharacteristicValueDTO $dto
    )
    {}

    public function run()
    {
        DB::table($this->getModel()->getTable())
            ->upsert(
                $this->dto->toArray(),
                ['title','characteristic_id'],// Поля для проверки уникальности
                ['title','characteristic_id']
            );
    }

}
