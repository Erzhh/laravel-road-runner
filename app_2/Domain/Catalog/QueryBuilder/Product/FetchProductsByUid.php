<?php
namespace Domain\Catalog\QueryBuilder\Product;

use Domain\Catalog\QueryBuilder\ProductQuery;

class FetchProductsByUid extends ProductQuery {

    private array $uids;
    private array $filds;
    private array $with;

    public function __construct( array $uids,array $filds,array $with)
    {
        $this->uids = $uids;
        $this->filds = $filds;
        $this->with = $with;
    }

    public function run()
    {
        $products = $this->getModel()->query()
                        ->select($this->filds)
                        ->with($this->with)
                        ->whereIn('uid',$this->uids)
                        ->get()->toBase();

        return $products;
    }

}
