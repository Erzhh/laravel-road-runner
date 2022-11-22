<?php

namespace API\Import\Controllers;

use API\Import\Requests\OnesImportCategoriesRequest;
use API\Import\Requests\OneSImportCharacteristicRequest;
use API\Import\Requests\OnesImportPriceDocumentRequest;
use API\Import\Requests\OneSImportProductRequest;
use API\Settings\Resources\CharacteristicMessageResource;
use App\Domain\GateWay\OneS\Actions\ProductImportOnesAction;
use App\Domain\Settings\CharMsg\Services\CharacteristicMessageStoreService;
use Core\BaseController;
use Domain\Import\Actions\PriceDocumentAction;
use Domain\Import\Services\CategoryImportOnesService;

class OneSController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function price_document(OnesImportPriceDocumentRequest $request)
    {
        (new PriceDocumentAction( $request->getDto() ))->run();

    }

    public function categories(OnesImportCategoriesRequest $request){
        $dto = $request->getDto();
        (new CategoryImportOnesService( $dto ))->run();
    }

    public function product(OneSImportProductRequest $request){
        $dto = $request->getDto();
        (new ProductImportOnesAction($dto))->run();
    }

    public function characteristics(OneSImportCharacteristicRequest $request)
    {
        $dto = $request->getDto();

        (new CharacteristicMessageStoreService($dto))->run();

//        return new CharacteristicMessageResource($char_msg);
    }

}
