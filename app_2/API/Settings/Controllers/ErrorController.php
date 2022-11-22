<?php

namespace API\Settings\Controllers;

use API\Settings\Requests\ErrorBaseRequest;
use API\Settings\Requests\ErrorRequest;
use API\Settings\Resources\ErrorPaginateResource;
use API\Settings\Resources\ErrorResource;
use App\Domain\GateWay\Telegram\Jobs\SendTelegramSmsJob;
use App\Domain\Settings\Errors\Services\ErrorDeleteService;
use App\Domain\Settings\Errors\Services\ErrorStoreService;
use Core\BaseController;
use Domain\Settings\Errors\Models\Error;
use Domain\Settings\Errors\QueryBuilder\FindErrorByIdQuery;
use Domain\Settings\Errors\QueryBuilder\GetAllPaginateErrorQuery;
use Illuminate\Support\Facades\Notification;

class ErrorController extends BaseController
{

    public function index(ErrorBaseRequest $request){
        $req = $request->getData();
        $errors = (new GetAllPaginateErrorQuery($req))->run();

        return new ErrorPaginateResource($errors);
    }

    public function store(ErrorRequest $request)
    {
        $dto = $request->getDto();

        SendTelegramSmsJob::dispatch($dto);

        $error = (new ErrorStoreService($dto))->run();

        return new ErrorResource($error);
    }

    public function show(ErrorBaseRequest $request,$error)
    {
        $req = $request->getData();
        $error_res = (new FindErrorByIdQuery($req, $error))->run();

        return new ErrorResource($error_res);
    }

    public function delete(Error $error)
    {
        (new ErrorDeleteService($error->id))->run();

        return response()->json('',204);
    }

}
