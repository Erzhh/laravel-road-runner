<?php
namespace App\Domain\Catalog\Services\Product;

use Domain\Catalog\Dto\ProductDto;
use Domain\Catalog\QueryBuilder\ProductQuery;
use Illuminate\Database\Eloquent\Model;

class ProductUpdateOrStoreService extends ProductQuery {

    public function __construct(
        private ProductDto $dto
    )
    {}

    public function run(): Model
    {
        return $this->getModel()
            ->newQuery()
            ->updateOrCreate(
                [ 'uid' => $this->dto->uid ],
                $this->dto->toArray()
            );
    }

}
