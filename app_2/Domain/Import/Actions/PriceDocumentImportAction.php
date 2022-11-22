<?php

namespace Domain\Import\Actions;


use API\Import\Requests\OnesImportPriceDocumentRequest;
use Domain\Import\Interfaces\CatalogRepository;
use Domain\Import\Services\PriceDocumentImportService;
use Illuminate\Support\Facades\App;

class PriceDocumentImportAction
{
    private CatalogRepository $repository;

    public function __construct()
    {
        $this->repository = App::make(CatalogRepository::class);
    }
    /**
     * Сохраняет в БД список тип цен
     *
     *  $apiData[0] = [
     *       "document_id" => "OF000000150",
     *       "document_uid" => "123123-143122-312-3-123",
     *       "user_uid" => "5e064181-a486-11ea-80bc-04d4c4d2e516",
     *       "user_name" => "Erzh",
     *       "items" => [
     *         {
     *           "product" => "dda48d4d-c291-11ea-80bc-04d4c4d2e516"
     *           "price_type" => "f3d61ccd-476c-11e7-80cc-1866da78d386"
     *           "cost" => 109970
     *         }
     *       ]
     * ];
     *
     * @return void
     */
    public function run(){
        $apiData = $this->repository->getPriceDocument();

        $request = new OnesImportPriceDocumentRequest($apiData);

        (new PriceDocumentImportService($request->getDto()))->run();
    }
}
