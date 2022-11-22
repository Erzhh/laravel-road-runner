<?php

namespace API\Access\Requests;

use API\Access\Requests\Messages\LoginMessages;
use App\Domain\Access\User\DTO\UserDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{

    public function rules()
    {
        return [
            'full_name' => 'required|string|max:50|min:2',
            'login' => 'required|string|unique:users,login',
            'password' => [
                'string','min:6','max:32',
                Rule::requiredIf(request('user') == null),
            ],
            'role_id' => 'integer|exists:roles,id',
            'warehouse_id' => 'nullable|integer',
        ];
    }

    public function messages()
    {
        return LoginMessages::toArray();
    }

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function getData(): UserDto
    {
        return new UserDto([
            'full_name' => $this->get('full_name'),
            'login' => $this->get('login'),
            'password' => $this->get('password'),
            'role_id' => $this->get('role_id'),
            'warehouse_id' => $this->get('warehouse_id')
        ]);
    }
}
