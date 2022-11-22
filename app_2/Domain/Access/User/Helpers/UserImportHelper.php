<?php

namespace App\Domain\Access\User\Helpers;

use API\Access\Helpers\UserHelper;
use Illuminate\Support\Facades\Hash;

class UserImportHelper{
    private UserHelper $helper;

    public function __construct()
    {
        $this->helper = new UserHelper();
    }

    public function generate($import_users, $roles, $warehouses): array
    {
        $user_password = $this->generatePassword();

        $users = [];
        foreach ($import_users as $user){

            $users[] = [
                'uid' =>            $user['guid'],
                'full_name' =>      $this->helper->FullName( $user['fullname'] ),
                'login' =>          $this->helper->makeShotName( $user['login'] ),
                'role_id' =>        $this->ArraySearchOrNullable( $user['position'], $roles),
                'warehouse_id' =>   $this->ArraySearchOrNullable( $user['warehouse'], $warehouses),
                'password' =>       $user_password
            ];

        }

        return $users;
    }

    private function generatePassword(): string
    {
        return Hash::make(env('SUPERADMIN_PASSWORD'));
    }

    private function ArraySearchOrNullable($array, $compare_array): int|string|null
    {
        $found_array = array_search( $array , $compare_array);
        return $found_array?$found_array:null;
    }

}
