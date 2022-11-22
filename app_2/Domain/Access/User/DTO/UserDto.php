<?php

namespace App\Domain\Access\User\DTO;

use App\Domain\Access\User\Repositories\UserGetUniqueToken;
use App\Domain\Access\User\Repositories\UserGetUniqueUid;
use Spatie\DataTransferObject\DataTransferObject;

class UserDto extends  DataTransferObject{

    public string $full_name;
    public string $login;
    public string|int $password;
    public int $role_id;
    public ?int $warehouse_id;

    public function toArray(): array
    {
     return [
            'full_name' => $this->full_name,
            'login' => $this->login,
            'password' => $this->password,
            'role_id' => $this->role_id,
            'warehouse_id' => $this->warehouse_id,
        ];
    }
}

