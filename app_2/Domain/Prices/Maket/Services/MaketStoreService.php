<?php
namespace App\Domain\Prices\Maket\Services;

use App\Domain\Prices\Maket\DTO\MaketsDTO;
use Domain\Prices\Maket\QueryBuilder\MaketQuery;
use Illuminate\Database\Eloquent\Model;

class MaketStoreService extends MaketQuery {

    public function __construct(
        private MaketsDTO $dto
    )
    {}

    public function run(): Model
    {
        return $this->getModel()
            ->newQuery()
            ->create(
                $this->dto->toArray()
            );
    }

}
