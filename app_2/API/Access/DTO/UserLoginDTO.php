<?php
namespace API\Access\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class UserLoginDTO extends  DataTransferObject{

    public string $login;
    public string $password;

}
