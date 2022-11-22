<?php

namespace App\API\Access\Requests;

use API\Access\DTO\UserLoginDTO;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class LoginRequest extends FormRequest
{

    public function rules()
    {
        return [
            'login' => 'required|string|exists:users,login',
            'password' => 'required|string|min:6|max:32'
        ];
    }

    /**
     * @throws UnknownProperties
     */
    public function getData(): UserLoginDTO
    {
        return new UserLoginDTO([
            'login' => $this->get('login'),
            'password' => $this->get('password')
        ]);
    }

}
