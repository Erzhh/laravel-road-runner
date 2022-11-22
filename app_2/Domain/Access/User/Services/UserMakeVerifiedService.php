<?php
namespace App\Domain\Access\User\Services;
use App\Domain\Access\User\DTO\UserDto;
use App\Domain\Access\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserMakeVerifiedService extends UserService{

    public function __construct(
         private User $user
    )
    {}

    public function  run(): bool
    {
        return  $this->getModel()
                    ->where('id', $this->user->id)
                    ->update(['is_verified' => 1]);
    }

}
