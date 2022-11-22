<?php
namespace App\Domain\Access\User\Services;

use API\Access\DTO\UserLoginDTO;
use Illuminate\Support\Facades\Hash;

class  UserRefreshPasswordService  extends  UserService{

    public function __construct(
        private UserLoginDTO $dto
    )
    {}

    public function  run()
    {
        $password = Hash::make($this->dto->password);

        $this->getModel()
             ->where('login', $this->dto->login)
             ->update(['password' => $password]);
    }

}
