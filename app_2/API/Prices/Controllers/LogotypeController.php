<?php

namespace API\Prices\Controllers;

use API\Prices\Requests\LogotypeRegularRequest;
use API\Prices\Requests\LogotypeRequest;
use API\Prices\Requests\LogotypeUpdateRequest;
use API\Prices\Resources\LogotypeResources;
use App\Domain\Prices\Logotype\Actions\LogotypeStoreAction;
use App\Domain\Prices\Logotype\Actions\LogotypeUpdateAction;
use App\Domain\Prices\Logotype\Models\Logotype;
use App\Domain\Prices\Logotype\QueryBuilder\FindByIdLogotype;
use App\Domain\Prices\Logotype\Services\LogotypeDestroyService;
use Core\BaseController;
use Domain\Prices\Logotype\QueryBuilder\GetAllLogotypes;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LogotypeController extends BaseController
{

    public function index(LogotypeRegularRequest $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $logo =(new GetAllLogotypes( $request->getData()  ))->run();

        return LogotypeResources::collection($logo);
    }

    public function store(LogotypeRequest $request): LogotypeResources
    {
        $dto = $request->getDto();
        $logo = (new LogotypeStoreAction($dto, $request->file('path')))->run();
        return new LogotypeResources($logo);
    }

    public function show(LogotypeRegularRequest $request, Logotype $logotype): LogotypeResources
    {
        $maket = (new FindByIdLogotype($logotype->id, $request->getData() ))->run();

        return new LogotypeResources($maket);
    }

    public function update(LogotypeUpdateRequest $request, Logotype $logotype): Response
    {
        $dto = $request->getDto();

        (new LogotypeUpdateAction($logotype, $dto, $request->file('path')??null))->run();

         return response()->noContent();
    }

    public function destroy(Logotype $logotype): Response
    {
        (new LogotypeDestroyService($logotype))->run();
        return response()->noContent();
    }

    public function categories(Request $request, Logotype $logotype){
        $logotype->categories()->sync($request->input('categories'));
    }

}
