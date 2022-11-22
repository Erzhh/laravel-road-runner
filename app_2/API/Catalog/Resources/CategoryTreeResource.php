<?php

namespace API\Catalog\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryTreeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'uid' => $this->uid,
            'children' => CategoryTreeResource::collection( $this->children )
        ];
    }
}
