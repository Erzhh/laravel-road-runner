<?php

namespace App\Domain\Access\Permissions\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PermissionFirstOrCreateService extends PermissionService{

    public function __construct(
        private string $permission
    )
    {}

    public function run(): Model|Builder
    {
        return $this->getModel()->query()
                        ->firstOrCreate([
                            'alias' =>  $this->permission
                        ]);
    }
}
