<?php

namespace API\Prices\Resources;

use API\Catalog\Resources\CategoryResource;
use Core\Resources\BaseJsonResource;

class LogotypeResources extends BaseJsonResource
{
    protected string $type = 'logotypes';

    public function getAttributes()
    {
        return [
            'title' => $this->resource->title,
            'path' =>  env('APP_URL').'/storage/'.$this->resource->path,
            'created_at' => $this->resource->created_at,
            'deleted_at' => $this->resource->deleted_at,
            'updated_at' => $this->resource->updated_at,
        ];
    }

    public function getIncluded()
    {
        return [
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
        ];
    }
}

