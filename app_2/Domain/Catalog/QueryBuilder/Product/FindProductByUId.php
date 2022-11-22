<?php
namespace Domain\Catalog\QueryBuilder\Product;

use Domain\Catalog\Models\Product;
use Domain\Catalog\QueryBuilder\ProductQuery;
use Illuminate\Database\Eloquent\Model;

class FindProductByUId extends ProductQuery {

    public function __construct(
        public string $uid,
        public $with = [],
    )
    {}

    public function run(array $fields = []): Model|null
    {
        return $this->getModel()->newQuery()
                    ->with($this->with)
                    ->when($fields,function ($q) use ($fields){
                        return $q->select($fields);
                    })
                    ->where('uid', $this->uid)
                    ->first();
    }

}
