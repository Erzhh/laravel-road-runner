<?php

namespace API\Prices\Controllers;


use API\Prices\Requests\CharacteristicValueRequest;
use API\Prices\Requests\CharacteristicValueUpdateRequest;
use API\Prices\Resources\CharacteristicValueResources;
use App\Domain\Prices\Characteristic\Models\CharacteristicsValue;
use App\Domain\Prices\Characteristic\QueryBuilder\CharacteristicsValue\GetAllCharacteristicValue;
use App\Domain\Prices\Characteristic\Services\CharacteristicValue\CharacteristicValueDestroyService;
use App\Domain\Prices\Characteristic\Services\CharacteristicValue\CharacteristicValueStoreService;
use App\Domain\Prices\Characteristic\Services\CharacteristicValue\CharacteristicValueUpdateService;
use Core\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CharacteristicValueController extends BaseController
{

    /**
     * @response 200
     * {"data":"Hello"}
     */
    public function index(): AnonymousResourceCollection
    {
        $formats =(new GetAllCharacteristicValue())->run();
        return CharacteristicValueResources::collection($formats);
    }

    /**
     * @response 200
     * {"data":"Hello"}
     */
    public function store(CharacteristicValueRequest $request): JsonResponse
    {
        $dto = $request->getDto();
        (new CharacteristicValueStoreService($dto))->run();

        return response()->json('Успешно создано',201);
    }

    /**
     * @response 200
     * {"data":"Hello"}
     */
    public function update(CharacteristicValueUpdateRequest $request, CharacteristicsValue $characteristic_value): Response
    {
        $dto = $request->getDto();

        (new CharacteristicValueUpdateService($characteristic_value, $dto))->run();
        return response()->noContent();
    }

    /**
     * @response 200
     * {"data":"Hello"}
     */
    public function destroy(CharacteristicsValue $characteristic_value): Response
    {
        (new CharacteristicValueDestroyService($characteristic_value))->run();
        return response()->noContent();
    }
}
