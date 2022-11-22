<?php

namespace App\API\Access\Requests;

use App\Domain\Access\User\DTO\UserTokenUpdateDto;
use Illuminate\Foundation\Http\FormRequest;

class UserTokenRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        $this->merge([
            'refresh_token' => $this->route('refresh_token')
        ]);
    }

    public function rules()
    {
        return [
            'refresh_token' => 'required|exists:users,refresh_token|string|min:10|max:36'
        ];
    }

    public function getData(): UserTokenUpdateDto
    {
        return new UserTokenUpdateDto([
            'refresh_token' => $this->get('refresh_token')
        ]);
    }
}
