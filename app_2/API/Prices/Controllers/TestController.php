<?php

namespace API\Prices\Controllers;

use App\Domain\Access\User\QueryBuilder\UserFindById;
use App\Domain\Prices\Printed\DTO\DocumentPrintedDTO;
use App\Domain\Prices\Printed\Jobs\DocumentPrintStatusPrintingJob;
use Core\BaseController;
use Illuminate\Support\Facades\Auth;

class TestController extends BaseController
{
    public function run(){

        $user_id = Auth::guard('api')->user()->id;
        $user = (new UserFindById($user_id))->run();

        $dto = new DocumentPrintedDTO([
            'document_uid'=>"04ca1ec0-d4d2-11ec-80cb-001e673e9623",
            'user_uid'=>$user['uid']
        ]);
        DocumentPrintStatusPrintingJob::dispatch($dto);

//        (new CheckPrintedDocumentAction("04ca1ec0-d4d2-11ec-80cb-001e673e9623"))->run();
    }

}
