<?php
namespace Domain\Catalog\QueryBuilder\Product;

use Domain\Catalog\QueryBuilder\ProductQuery;
use Illuminate\Database\Eloquent\Model;
class FindProductById extends ProductQuery {


    public function __construct(
        private int $id,
        public $with = [],
    )
    {}

    public function run(): Model
    {
        $product = $this->getModel()
                        ->with($this->with)
                        ->find($this->id);

        return $product;
    }

}
