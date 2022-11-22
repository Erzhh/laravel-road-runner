<?php
namespace App\Domain\Catalog\Services\ProductDetail;

use Domain\Catalog\Dto\ProductDetailDto;
use Domain\Catalog\QueryBuilder\ProductDetailQuery;
use Illuminate\Database\Eloquent\Model;

class ProductDetailUpdateOrStoreService extends ProductDetailQuery {

    public function __construct(
        private ProductDetailDto $dto
    )
    {}

    public function run(): Model
    {
        return $this->getModel()
            ->newQuery()
            ->updateOrCreate(
                [ 'product_uid' => $this->dto->product_uid ],
                $this->dto->toArray()
            );
    }

}
