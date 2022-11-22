<?php

namespace API\Prices\Controllers;

use API\Prices\Requests\CharacteristicProductRegularRequest;
use API\Prices\Requests\CharacteristicProductRequest;
use API\Prices\Requests\CharacteristicProductUpdateRequest;
use API\Prices\Resources\CharacteristicProductResources;
use App\Domain\Prices\Characteristic\Models\CharacteristicsProduct;
use App\Domain\Prices\Characteristic\QueryBuilder\CharacteristicsProduct\CharacteristicProductFindByCharacteristicIdQuery;
use App\Domain\Prices\Characteristic\QueryBuilder\CharacteristicsProduct\GetAllCharacteristicProductQuery;
use App\Domain\Prices\Characteristic\Services\CharacteristicProduct\CharacteristicProductDestroyService;
use App\Domain\Prices\Characteristic\Services\CharacteristicProduct\CharacteristicProductStoreService;
use App\Domain\Prices\Characteristic\Services\CharacteristicProduct\CharacteristicProductUpdateService;
use Core\BaseController;
use Illuminate\Http\Response;

class CharacteristicProductController extends BaseController
{

    public function index()
    {
        $formats =(new GetAllCharacteristicProductQuery())->run();
        return CharacteristicProductResources::collection($formats);
    }

    public function store(CharacteristicProductRequest $request)
    {
        $dto = $request->getDto();
        $characteristic = (new CharacteristicProductStoreService($dto))->run();

        return new CharacteristicProductResources($characteristic);
    }

    public function show(CharacteristicProductRegularRequest $request, $characteristic_product){
        $characteristic = (new CharacteristicProductFindByCharacteristicIdQuery($characteristic_product, $request->getData()))->run();
        return CharacteristicProductResources::collection($characteristic);
    }

    public function update(CharacteristicProductUpdateRequest $request, CharacteristicsProduct $characteristic_product)
    {
        $dto = $request->getDto();
        (new CharacteristicProductUpdateService($characteristic_product, $dto))->run();
        return response()->noContent();
    }

    public function destroy(CharacteristicsProduct $characteristic_product): Response
    {
        (new CharacteristicProductDestroyService($characteristic_product))->run();
        return response()->noContent();
    }
}
