<?php
namespace App\Domain\Catalog\Services\ProductBonus;

use Domain\Catalog\Dto\ProductBonusDto;
use Domain\Catalog\QueryBuilder\ProductBonusQuery;
use Illuminate\Database\Eloquent\Model;

class ProductBonusStoreService extends ProductBonusQuery {

    public function __construct(
        private ProductBonusDto $dto
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
