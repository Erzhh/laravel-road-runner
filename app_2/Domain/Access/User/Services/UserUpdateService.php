<?php
namespace App\Domain\Access\User\Services;
use App\Domain\Access\User\DTO\UserDto;
use App\Domain\Access\User\Models\User;
use Illuminate\Support\Facades\Hash;

class  UserUpdateService {

    public function __construct(
         private User $user,
         private UserDto $dto
    )
    {}

    public function  run(): bool
    {
        $this->dto->password = $this->ganeratePassword();

        return $this->user->update(
                                    $this->dto->toArray()
                                );
    }

    private function ganeratePassword(){
        return $this->dto->password
                            ? Hash::make($this->dto->password)
                            : $this->user->password;
    }
}
