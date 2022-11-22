<?php

namespace API\Prices\Controllers;

use API\Prices\Requests\CharacteristicProductSettingUpdateRequest;
use App\Domain\Prices\Characteristic\Actions\GetAllSimilarCharacteristicProductAction;
use App\Domain\Prices\Characteristic\Actions\UpsertCharacteristicProductAction;
use Core\BaseController;
use Domain\Catalog\Models\Product;

class CharacteristicProductSettingController extends BaseController
{

    public function similars_get(Product $product)
    {
        $formats = (new GetAllSimilarCharacteristicProductAction($product))->run();

        return $formats;
    }

    public function similars_update(CharacteristicProductSettingUpdateRequest $request)
    {
       return (new UpsertCharacteristicProductAction($request->getDto()))->run();
    }

}
