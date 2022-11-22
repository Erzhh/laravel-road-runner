<?php

namespace API\Access\Requests\Messages;

class LoginMessages{

    public static function toArray(){
        return [
            'full_name.required' => 'Пожалуйста, заполните поле',
            'login.required' => 'Пожалуйста, заполните поле',

            'full_name.string' => 'Поле должно содержать только буквы',
            'login.string' => 'Поле должно содержать только буквы',

            'login.integer' => 'Поле должно содержать только цифры',
            'warehouse_id.integer' => 'Поле должно содержать только цифры',

            'full_name.max' => 'Поле должно содержать менее 50 символов',
            'password.max' => 'Поле должно содержать менее 32 символов',

            'full_name.min' => 'Поле должно содержать более 2 символов',
            'password.min' => 'Поле должно содержать более 6 символов',

            'login.unique' => 'Такой пользователь уже существует',

            'role_id.exists'=>'Роли не существует',
        ];
    }
}

?>
