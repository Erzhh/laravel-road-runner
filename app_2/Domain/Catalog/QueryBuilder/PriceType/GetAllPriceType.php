<?php
namespace Domain\Catalog\QueryBuilder\PriceType;

use Domain\Catalog\QueryBuilder\PriceTypeQuery;
use Illuminate\Database\Eloquent\Collection;

class GetAllPriceType extends PriceTypeQuery {


    public function run(): Collection|array
    {
        $instance = $this->getModel()->newQuery()->get();;

        return $instance;
    }

}
