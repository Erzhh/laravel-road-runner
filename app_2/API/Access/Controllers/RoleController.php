<?php

namespace API\Access\Controllers;

use API\Access\Resources\RoleOutSideResource;
use App\Domain\Access\Roles\Actions\RoleStoreAction;
use App\Domain\Access\Roles\Actions\RoleUpdateAction;
use App\Domain\Access\Roles\Models\Role;
use App\Domain\Access\Roles\QueryBuilder\GetAllRolesQuery;
use API\Access\Requests\RoleStoreRequest;
use API\Access\Resources\RoleResource;
use Core\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * @group Управление ролями
 */
class RoleController extends BaseController
{

    /**
     * @return RoleOutSideResource
     *
     * @authenticated
     * @header Berrar *****.*******.***
     * @response 200
     * {"roles":[{"title":"Суперадмин","permissions":[{"id":1,"alias":"super.admin","title":null,"service_id":null,"is_show":1}]},{"title":"Клиент","permissions":[{"id":1,"alias":"super.admin","title":null,"service_id":null,"is_show":1}]}]}
     */
    public function index(): RoleOutSideResource
    {
        $roles = (new GetAllRolesQuery())->run();

        return  new RoleOutSideResource($roles);
    }

    /**
     * @throws \Exception
     */
    public function store(RoleStoreRequest $request): RoleResource
    {
        $dto = $request->getData();
        $role = (new RoleStoreAction($dto))->run();

        return new RoleResource($role);
    }

    public function show( Role $role ): JsonResponse
    {
        return  response()->json($role,200);
    }

    /**
     * @throws \Exception
     */
    public function update(Role $role , RoleStoreRequest $request, ): Response
    {
        $dto = $request->getData();
        (new RoleUpdateAction($role, $dto))->run();

        return response()->noContent(204);
    }
}
