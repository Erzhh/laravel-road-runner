<?php

namespace App\Domain\Access\Permissions\Actions;

use App\Domain\Access\Permissions\Services\PermissionStoreService;
use App\Domain\Import\Services\RoleImportService;
use App\Domain\Import\Services\UserImportService;
use Illuminate\Support\Facades\DB;

class PermissionStoreImportAction {

    public function __construct()
    {}

    public function run(): void
    {
        try {
            DB::beginTransaction();

            echo 'Импорт из сервисов ...';
            echo PHP_EOL;
                $permissions = (new PermissionImportAction())->run();

            echo 'Сохранение ...';
            echo PHP_EOL;
                (new PermissionStoreService($permissions))->run();


            DB::commit();
        } catch (\Exception $e) {

            DB::rollback();
            throw $e;

        }

    }
}
