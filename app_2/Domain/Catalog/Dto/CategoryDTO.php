<?php

namespace App\Domain\Catalog\Dto;

use Spatie\DataTransferObject\DataTransferObject;

class CategoryDTO extends DataTransferObject {

    public string $id;
    public string $guid;
    public string $name;
    public int $parent_id;
    public ?string $parent_guid;
    public bool $status;

    public function toArray(): array
    {
        return [
            'uid' => $this->guid,
            'parent_id' => $this->parent_id,
            'name' => $this->name,
            'code' => $this->id,
            'status' => $this->status,
        ];
    }

    public function setParentId(int $id){
        $this->parent_id = $id;
    }
}
