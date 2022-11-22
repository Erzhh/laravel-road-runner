<?php
namespace App\Domain\Access\User\Services;

use App\Domain\Access\User\DTO\UserDto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserStoreService extends UserService{

    public function __construct(
         private UserDto $dto
    )
    {}

    public function run(): Model
    {
        $this->dto->password = $this->generatePassword();

        $user =  $this->getModel()
                        ->newQuery()
                        ->create(
                            $this->dto->toArray()
                        );
        return  $user;
    }

    private function generatePassword(){
        return $this->dto->password
                            ? Hash::make($this->dto->password)
                            : $this->dto->password;
    }
}
