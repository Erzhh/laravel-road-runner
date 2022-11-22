<?php

namespace API\Prices\Controllers;

use API\Prices\Requests\DocumentPrintedRequest;
use API\Prices\Resources\DocumentPrintedResources;
use App\Domain\Prices\Printed\QueryBuilder\DocumentPrintedFindByUid;
use Core\BaseController;

class PriceDocumentPrintController extends BaseController
{

    public function store(DocumentPrintedRequest $request)
    {
        $dto = $request->getDto();

        $documents =(new DocumentPrintedFindByUid( $dto, $request->getData() ))->run();

        return DocumentPrintedResources::collection($documents);
    }

}
