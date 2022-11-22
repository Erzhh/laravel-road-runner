<?php
namespace App\Domain\Settings\CharMsg\Services;

use App\Domain\Settings\CharMsg\DTO\CharacteristicMessageDTO;
use Domain\Settings\CharMsg\QueryBuilder\CharacteristicMessageQuery;
use Illuminate\Database\Eloquent\Model;

class CharacteristicMessageStoreService extends CharacteristicMessageQuery {

    public function __construct(
        private CharacteristicMessageDTO $dto
    ){}

    public function run(): Model
    {
        return $this->getModel()
                    ->newQuery()
                    ->create($this->dto->toArray());
    }

}
