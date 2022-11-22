<?php

namespace API\Access\Controllers;

use API\Access\Requests\UserRequest;
use API\Access\Requests\UserStoreRequest;
use API\Access\Requests\UserUpdateRequest;
use API\Access\Resources\UserResource;
use App\Domain\Access\User\Actions\UserStoreAction;
use App\Domain\Access\User\Models\User;
use App\Domain\Access\User\QueryBuilder\UserFindById;
use App\Domain\Access\User\QueryBuilder\UserGetAll;
use App\Domain\Access\User\Services\UserUpdateService;
use Core\BaseController;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;


/**
 * @group Управление пользователями
 */
class UserController extends BaseController
{
    /**
     * Список Пользователей
     *
     * @authenticated
     * @header Berrar *****.*******.***
     * @response 200
     * [{"type":"users","id":1,"attributes":{"full_name":"Adminbek adminov","login":"Erzh"},"included":[],"links":{"role":"http://gateway.retail.citrius.xyz/api/v1/roles/1"}}]
     */
    public function index(UserRequest $request): AnonymousResourceCollection
    {
        $dto = $request->getData();
        $users = (new UserGetAll($dto))->run();
        return UserResource::collection($users);
    }

    /**
     *
     * @authenticated
     *
     * @bodyParam first_name string required Example: "Nursultan"
     * @bodyParam sur_name string required Example: "Nazarbaev"
     * @bodyParam login string required unique:users string Example: "77477474747"
     * @bodyParam password string required min:6 max:20 Example: "NurOtan2021"
     * @bodyParam gender string   required male|female Example: male
     * @bodyParam birthday date required  Example: 2022-01-01
     *
     * @response 201
     * {"data":{"type":"users","id":777,"attributes":{"first_name":"Nursultan","sur_name":"Nazarbaev","login":"77477474747","role_id":2}}}
    */
    public function store(UserStoreRequest $request): UserResource
    {
        $dto = $request->getData();

        $user = (new UserStoreAction($dto))->run();

        return new UserResource($user);
    }

    /**
     * Show user
     * @param User $user
     *
     * @authenticated
     *
     * @header Berrar *****.*******.***
     *
     * @response 200
     * {"type":"users","id":1,"attributes":{"full_name":"Adminbek adminov","login":"Erzh"},"included":[],"links":{"role":"http://gateway.retail.citrius.xyz/api/v1/roles/1"}}
     *
     * @response status=401
     * "message": "Authorization Token not found",
     */
    public function show(User $user)
    {
       $user = (new UserFindById($user->id))->run();

        return new UserResource($user);
    }

    /**
     * @bodyParam first_name string required Example: "Kasim-Zhomart"
     * @bodyParam sur_name string required Example: "Tokaev"
     * @bodyParam login string required unique:users string Example: "77027020202s"
     * @bodyParam password string required min:6 max:20 Example: "Amanat2022"
     * @bodyParam gender string   required male|female Example: male
     * @bodyParam birthday date required  Example: 2022-01-01
     *
     * @response 204
     * No Content
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function update(UserUpdateRequest $request, User $user): Response
    {
        $dto = $request->getData();
        (new UserUpdateService($user,$dto))->run();

        return response()->noContent();
    }
}
