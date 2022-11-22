<?php

namespace API\Prices\Controllers;

use API\Prices\Requests\MaketRegularRequest;
use API\Prices\Requests\MaketRequest;
use API\Prices\Resources\MaketResources;
use App\Domain\Prices\Maket\Models\Maket;
use App\Domain\Prices\Maket\Services\MaketDestroyService;
use App\Domain\Prices\Maket\Services\MaketStoreService;
use App\Domain\Prices\Maket\Services\MaketUpdateService;
use Core\BaseController;
use Domain\Prices\Maket\QueryBuilder\GetAllPaginateMaket;
use Domain\Prices\Maket\QueryBuilder\MaketFindById;
use Illuminate\Http\Response;

class MaketController extends BaseController
{

    public function index(MaketRegularRequest $request)
    {
        $makets =(new GetAllPaginateMaket( $request->getData() ))->run();

        return MaketResources::collection($makets);
    }

    public function store(MaketRequest $request)
    {
        $dto = $request->getDto();
        $bonus = (new MaketStoreService($dto))->run();

        return new MaketResources($bonus);
    }

    public function show(MaketRegularRequest $request, Maket $maket)
    {
        $maket = (new MaketFindById($maket->id, $request->getData() ))->run();

        return new MaketResources($maket);
    }

    public function update(MaketRequest $request, Maket $maket): Response
    {
        $dto = $request->getDto();
        (new MaketUpdateService($maket, $dto))->run();

        return response()->noContent();
    }

    public function destroy(Maket $maket): Response
    {
        (new MaketDestroyService($maket))->run();
        return response()->noContent();
    }
}
