<?php

namespace App\Domain\Access\Roles\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class RoleStoreDTO extends DataTransferObject{

    public string $title;
    public array  $permissions;

}
