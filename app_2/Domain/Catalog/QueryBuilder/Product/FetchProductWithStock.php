<?php
namespace Domain\Catalog\QueryBuilder\Product;

use Domain\Catalog\Dto\ProductStockDto;
use Domain\Catalog\QueryBuilder\ProductQuery;
use Illuminate\Database\Eloquent\Collection;

class FetchProductWithStock extends ProductQuery
{

    public function __construct(
        private ProductStockDto $dto,
        private array           $with = []
    )
    {}

    public function run(): Collection|array
    {

        $issetArray = $this->arrayIsset($this->with, 'stock');
        $arrayExclude = $this->arrayExclude($this->with, 'stock');

        $query = $this->getModel()->query()
            ->select(['id', 'uid', 'name'])
            ->when($issetArray,function ($q){
                $q->with([
                    'stock' => function ($query) {
                        return $query->where([
                            'warehouse_id' => $this->dto->warehouse_id,
                            'quality_id' => $this->dto->quality_id
                        ]);
                    }
                ]);
            })
            ->whereIn('uid', $this->dto->uid)
            ->with($arrayExclude)
            ->get();

        return $query;
    }

    private function arrayExclude($array, $value)
    {
        $result = array_keys($array, $value);
        if(!empty($result)){
            unset($array[$result[0]]);
        }
        return $array;
    }

    private function arrayIsset($array, $value)
    {
        $result = array_keys($array, $value);
        return !empty($result);
    }
}
