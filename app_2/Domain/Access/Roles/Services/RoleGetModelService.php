<?php
    namespace App\Domain\Access\Roles\Services;

    use App\Domain\Access\Roles\Models\Role;
    use Core\BaseService;
    use Illuminate\Database\Eloquent\Model;

class RoleGetModelService extends BaseService {

    function getModel(): Model
    {
        return  new Role();
    }

}
