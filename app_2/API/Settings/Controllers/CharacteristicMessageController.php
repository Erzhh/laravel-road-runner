<?php

namespace API\Settings\Controllers;

use API\Settings\Requests\CharacteristicMessageBaseRequest;
use API\Settings\Resources\CharacteristicMessagePaginateResource;
use App\Domain\Settings\CharMsg\Models\CharacteristicMessage;
use App\Domain\Settings\CharMsg\Services\CharacteristicMessageDeleteService;
use Core\BaseController;
use Domain\Settings\CharMsg\QueryBuilder\GetAllPaginateCharacteristicMessageQuery;

class CharacteristicMessageController extends BaseController
{

    public function index(CharacteristicMessageBaseRequest $request){
        $req = $request->getData();
        $char_msg = (new GetAllPaginateCharacteristicMessageQuery($req))->run();

        return new CharacteristicMessagePaginateResource($char_msg);
    }

    public function destroy(CharacteristicMessage $characteristic_message): \Illuminate\Http\JsonResponse
    {
        (new CharacteristicMessageDeleteService($characteristic_message->id))->run();

        return response()->json('',204);
    }

}
