<?php

namespace API\Catalog\Controllers;

use API\Catalog\Requests\PriceHistoryRequest;
use API\Catalog\Resources\PriceHistoryPaginateRecourse;
use API\Catalog\Resources\PriceHistoryResource;
use Core\BaseController;
use Domain\Catalog\Models\PriceDocument;
use Domain\Catalog\Models\PriceHistory;
use Domain\Catalog\QueryBuilder\PriceHistory\FindByIdPriceHistory;
use Domain\Catalog\QueryBuilder\PriceHistory\GetAllPriceHistory;
use Domain\Catalog\QueryBuilder\PriceHistory\PriceHistoryByDocumentIdPaginateQuery;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PriceHistoryController extends BaseController
{
    public function index(PriceHistoryRequest $request): AnonymousResourceCollection
    {
        $request_data = $request->getData();
        $histories = (new GetAllPriceHistory($request_data))->run();

       return PriceHistoryResource::collection($histories);
    }

    public function show(PriceHistoryRequest $request,PriceHistory $id): PriceHistoryResource
    {
        $request_data = $request->getData();
        $histories = (new FindByIdPriceHistory($request_data,$id))->run();

        return new PriceHistoryResource($histories);
    }

    public function parent(PriceDocument $document, PriceHistoryRequest $request){

        $request_dto = $request->getData();
        $histories = (new PriceHistoryByDocumentIdPaginateQuery($document,$request_dto))->run();

        return  new PriceHistoryPaginateRecourse($histories);
    }
}
