<?php

namespace API\Settings\Requests;

use App\Domain\Settings\Errors\DTO\ErrorDTO;
use Core\Request\BaseRequestParams;

class ErrorRequest extends BaseRequestParams
{
    public function rules()
    {
        return [
            parent::rules(),
            'user_id'   =>   ['required','integer','exists:users,id'],
            'status'    =>   ['required','integer'],
            'message'    =>   ['required','string','max:255'],
            'data'    =>   ['required'],
        ];
    }

    public function getDto(): ErrorDTO
    {
        return new ErrorDTO([
            'user_id' => $this->get('user_id'),
            'status' => $this->get('status'),
            'message' => $this->get('message'),
            'data' => json_encode( $this->get('data') ),
        ]);
    }
}
