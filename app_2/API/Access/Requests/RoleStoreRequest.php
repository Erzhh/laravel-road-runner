<?php

namespace API\Access\Requests;

use App\Domain\Access\Roles\DTO\RoleStoreDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleStoreRequest extends FormRequest
{

    protected function prepareForValidation(){
        $this->merge( ['id' => $this->route('role')->id??null] );
    }

    public function rules()
    {
        return [
            'title' => [
                'required', 'string', 'min:2', 'max:20',
                Rule::unique('roles', 'title')->ignore($this->input('id')),
            ],
            'permissions' => 'required|array',
            'permissions.*' => [
                'string'
            ]
        ];
    }

    public function messages()
    {
        return [
            'permission.*.in' => "Нет такого прав"
        ];
    }

    public function getData(){
        return new RoleStoreDTO([
            'title' => $this->get('title'),
            'permissions' => $this->get('permissions')
        ]);
    }

}
