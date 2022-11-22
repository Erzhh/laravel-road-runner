<?php
namespace App\Domain\Prices\Bonus\Services;

use App\Domain\Prices\Bonus\DTO\BonusDTO;
use Domain\Prices\Bonus\QueryBuilder\BonusQuery;
use Illuminate\Database\Eloquent\Model;

class BonusStoreService extends BonusQuery {

    public function __construct(
        private BonusDTO $dto
    )
    {}

    public function run(): Model
    {
        return $this->getModel()
            ->newQuery()
            ->updateOrCreate(
                ['user_uid'=> $this->dto->user_uid]
                ,$this->dto->toArray()
            );
    }

}
