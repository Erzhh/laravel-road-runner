<?php

namespace API\Prices\Controllers;

use API\Prices\Requests\BonusRegularRequest;
use API\Prices\Requests\BonusRequest;
use API\Prices\Requests\BonusStoreRequest;
use API\Prices\Resources\BonusResources;
use App\Domain\Prices\Bonus\Models\Bonus;
use App\Domain\Prices\Bonus\Services\BonusDestroyService;
use App\Domain\Prices\Bonus\Services\BonusUpdateService;
use App\Domain\Prices\Bonus\Services\BonusStoreService;
use Core\BaseController;
use Domain\Prices\Bonus\QueryBuilder\BonusFindById;
use Domain\Prices\Bonus\QueryBuilder\GetAllBonus;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class BonusController extends BaseController
{

    public function index(): AnonymousResourceCollection
    {
        $bonuses =(new GetAllBonus())->run();

        return BonusResources::collection($bonuses);
    }

    public function store(BonusStoreRequest $request): BonusResources
    {
        $dto = $request->getDto();
        $bonus = (new BonusStoreService($dto))->run();

        return new BonusResources($bonus);
    }

    public function show(BonusRegularRequest $request, Bonus $bonus): BonusResources
    {
        $bonuses = (new BonusFindById($bonus->id, $request->getData() ))->run();

        return new BonusResources($bonuses);
    }

    public function update(BonusRequest $request, Bonus $bonus): Response
    {
        $dto = $request->getDto();
        (new BonusUpdateService($bonus, $dto))->run();

        return response()->noContent();
    }

    public function destroy(Bonus $bonus): Response
    {
        (new BonusDestroyService($bonus))->run();
        return response()->noContent();
    }
}
