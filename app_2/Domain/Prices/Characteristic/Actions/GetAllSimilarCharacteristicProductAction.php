<?php

namespace App\Domain\Prices\Characteristic\Actions;


use App\Domain\Prices\Characteristic\DTO\CharacteristicSimilarDTO;
use App\Domain\Prices\Characteristic\QueryBuilder\CharacteristicsProduct\CharacteristicProductFindByProductUidQuery;
use App\Domain\Prices\Characteristic\QueryBuilder\CharacteristicsProduct\GetAllSimilarCharacteristicProductQuery;
use Domain\Catalog\Models\Product;

class GetAllSimilarCharacteristicProductAction {

    public function __construct(
      public Product $product
    )
    {}

    public function run()
    {

        $characteristic = (new CharacteristicProductFindByProductUidQuery($this->product->uid))->run();
        $characteristic_ids =   $characteristic->pluck('characteristic_id')->all();

        $dto = new CharacteristicSimilarDTO([
            'uids' => $characteristic_ids,
            'product_uid' => $this->product->uid
        ]);

        $formats = (new GetAllSimilarCharacteristicProductQuery($dto))->run();

        return $formats;
    }
}
