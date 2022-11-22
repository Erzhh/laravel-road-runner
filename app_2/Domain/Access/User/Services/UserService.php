<?php

namespace App\Domain\Access\User\Services;

use App\Domain\Access\User\Models\User;
use Core\BaseService;
use Illuminate\Database\Eloquent\Model;

class UserService extends BaseService
{
    function getModel(): Model
    {
        return new User();
    }

}
