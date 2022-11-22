<?php

namespace API\Prices\Controllers;

use API\Prices\Requests\FormatRequest;
use API\Prices\Requests\FormatUpdateRequest;
use API\Prices\Resources\FormatResources;
use App\Domain\Prices\Format\Models\Format;
use App\Domain\Prices\Format\Services\FormatDestroyService;
use App\Domain\Prices\Format\Services\FormatStoreService;
use App\Domain\Prices\Format\Services\FormatUpdateService;
use Core\BaseController;
use Domain\Prices\Format\QueryBuilder\GetAllFormat;
use Illuminate\Http\Response;

class FormatController extends BaseController
{

    public function index()
    {
        $formats =(new GetAllFormat())->run();
        return FormatResources::collection($formats);
    }

    public function store(FormatRequest $request)
    {
        $dto = $request->getDto();
        $format = (new FormatStoreService($dto))->run();

        return new FormatResources($format);
    }

    public function update(FormatUpdateRequest $request, Format $format): Response
    {
        $dto = $request->getData();

        (new FormatUpdateService($format, $dto))->run();
        return response()->noContent();
    }

    public function destroy(Format $format): Response
    {
        (new FormatDestroyService($format))->run();
        return response()->noContent();
    }
}
