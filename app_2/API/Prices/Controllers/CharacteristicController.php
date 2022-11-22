<?php

namespace API\Prices\Controllers;

use API\Prices\Requests\CharacteristicRegularRequest;
use API\Prices\Requests\CharacteristicRequest;
use API\Prices\Resources\CharacteristicResources;
use App\Domain\Prices\Characteristic\Models\Characteristic;
use App\Domain\Prices\Characteristic\QueryBuilder\Characteristics\CharacteristicFindById;
use App\Domain\Prices\Characteristic\QueryBuilder\Characteristics\GetAllPaginateCharacteristic;
use App\Domain\Prices\Characteristic\Services\Characteristic\CharacteristicDestroyService;
use App\Domain\Prices\Characteristic\Services\Characteristic\CharacteristicStoreService;
use App\Domain\Prices\Characteristic\Services\Characteristic\CharacteristicUpdateService;
use Core\BaseController;

class CharacteristicController extends BaseController
{

    public function index(CharacteristicRegularRequest $request)
    {
        $formats =(new GetAllPaginateCharacteristic( $request->getData() ))->run();
        return CharacteristicResources::collection($formats);
    }

    public function store(CharacteristicRequest $request)
    {
        $dto = $request->getDto();
        $characteristic = (new CharacteristicStoreService($dto))->run();

        return new CharacteristicResources($characteristic);
    }

    public function show(CharacteristicRegularRequest $request, Characteristic $characteristic)
    {
        $charac = (new CharacteristicFindById($characteristic->id, $request->getData() ))->run();

        return new CharacteristicResources($charac);
    }

    public function update(CharacteristicRequest $request, Characteristic $characteristic)
    {
        $dto = $request->getDto();
        (new CharacteristicUpdateService($characteristic, $dto))->run();
        return response()->noContent();
    }

    public function destroy(Characteristic $characteristic)
    {
        (new CharacteristicDestroyService($characteristic))->run();
        return response()->noContent();
    }
}
