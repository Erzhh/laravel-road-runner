<?php

namespace API\Catalog\Controllers;

use API\Catalog\Collections\PriceDocumentCollection;
use API\Catalog\Requests\PriceDocumentRequest;
use API\Catalog\Resources\PriceDocumentResource;
use Core\BaseController;
use Domain\Catalog\QueryBuilder\PriceDocument\FindByIdPriceDocument;
use Domain\Catalog\QueryBuilder\PriceDocument\GetAllPriceDocument;

class PriceDocumentController extends BaseController
{

    public function index(PriceDocumentRequest $request): PriceDocumentCollection
    {
        $request_data = $request->getData();

        $documents = (new GetAllPriceDocument($request_data))->run();

        return new PriceDocumentCollection($documents);
    }

    public function show(PriceDocumentRequest $request, $id): PriceDocumentResource
    {
        $dto = $request->getData();


        $documents = (new FindByIdPriceDocument(
                        $dto,
                        $id
                    ))->run();

        return new PriceDocumentResource($documents);
    }

}
