<?php
    namespace App\Domain\Access\Permissions\Actions;

use App\Domain\Access\Permissions\Models\Permission;
use Illuminate\Database\Eloquent\Collection;

class PermissionExportAction {

    public function __construct(
        private int $service_id
    ){}

    public function run(): Collection|array
    {
        $permissions =  Permission::query()
                                    ->where('service_id',$this->service_id)
                                    ->with([
                                        'roles'=>function($q){
                                            $q->select('id');
                                        }
                                    ])
                                    ->get();

        return $permissions;
    }
}
