<?php

namespace API\Settings\Resources;

use API\Access\Resources\UserResource;
use Core\Resources\BaseFildsJsonResource;
use Domain\Settings\Errors\Models\Error;
use Illuminate\Database\Eloquent\Model;
use PhpParser\JsonDecoder;

class ErrorResource extends BaseFildsJsonResource
{
    protected string $type = 'errors';

    function getModel(): Model{
        return  new Error();
    }


    function getAttributes()
    {
        return [
            "user_id" => $this->user_id,
            "status" => $this->status,
            "message" =>  $this->message,
            "data" =>  json_decode(  $this->data),
            "created_at" =>  $this->created_at,
            "updated_at" =>  $this->updated_at
        ];
    }


    public function getIncluded()
    {
        return [
            'parent' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
