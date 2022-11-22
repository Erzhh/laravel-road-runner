<?php

namespace API\Access\Controllers;

use API\Access\Requests\UserRequest;
use API\Access\Resources\UserResource;
use App\API\Access\Requests\LoginRequest;
use App\API\Access\Requests\UserTokenRequest;
use App\Domain\Access\Auth\Actions\AuthLoginAction;
use App\Domain\Access\Auth\Actions\AuthRefreshAction;
use App\Domain\Access\User\QueryBuilder\UserFindById;
use Core\BaseController;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    /**
     * @bodyParam login string required Example: 777777777
     * @bodyParam password string required Example: qwe123rt
     *

     * @response
     * {"access_token":"*******.*****.*****","token_type":"bearer","expires_in":129600,"refresh_token":"ef9aca13-3098-49df-82b4-b4e77a258ba3"}
     */
    public function login(LoginRequest $request): JsonResponse
    {
            $dto = $request->getData();
      return (new AuthLoginAction( $dto ))->run();
    }

    /**
     * Logout.
     *
     * @authenticated
     * @header Berrar *****.*******.***
     * @response 204
     * []
     */
    public function logout(): JsonResponse
    {
        $this->guard('api')->logout();
        return response()->json(['message' => 'Успешно вышел из системы'], 204);
    }

    /**
     * Get the authenticated User
     *
     * @authenticated
     * @header Berrar ****.*****.****
     * @responce 200
     * {"type":"users","id":1,"attributes":{"first_name":"Adminbek","sur_name":"adminov","login":"77777777777","role_id":1}}
     * @responce 401
     * "message": "Token not provided" {}
     */
    public function me(UserRequest $request): UserResource
    {
        $dto = $request->getData();
        $user = (new UserFindById($this->guard()->user()->id, $dto))->run();

        return new UserResource($user);
    }

    /**
     * Refresh a token.
     *
     * @response 204
     * {"access_token":"*****.*****.*****","token_type":"bearer","expires_in":129600,"refresh_token":"ef9aca13-3098-49df-82b4-b4e77a258ba3"}
     */
    public function refresh(UserTokenRequest $refresh_token): JsonResponse
    {
            $dto = $refresh_token->getData();
            $access_token = (new AuthRefreshAction( $dto ))->run();

        return response()->json($access_token);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return Guard
     */
    private function guard(string $ui = 'api'): Guard
    {
        return Auth::guard($ui);
    }
}
