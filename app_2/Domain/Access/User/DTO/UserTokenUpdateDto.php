<?php

namespace App\Domain\Access\User\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class UserTokenUpdateDto extends  DataTransferObject{

    public string $refresh_token;

}
