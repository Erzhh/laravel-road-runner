<?php

namespace API\Prices\Controllers;

use API\Prices\Requests\DocHistoryPrintedRequest;
use API\Prices\Requests\DocumentPrintedRequest;
use API\Prices\Resources\DocumentPrintedResources;
use App\Domain\Prices\Printed\Actions\DocumentHistoryStoreOrUpdateAction;
use App\Domain\Prices\Printed\QueryBuilder\DocumentPrintedFindByUid;
use Core\BaseController;

class PrintedController extends BaseController
{

    public function documents(DocumentPrintedRequest $request)
    {
        $dto = $request->getDto();

        $documents =  (new DocumentPrintedFindByUid( $dto, $request->getData() ))->run();

        return DocumentPrintedResources::collection($documents);
    }

    public function products(DocHistoryPrintedRequest $request)
    {
        $dto = $request->getDto();

            (new DocumentHistoryStoreOrUpdateAction($dto))->run();
        return $this->ok();
    }
}
