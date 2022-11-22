<?php

namespace API\Prices\Requests;

use App\Domain\Prices\Logotype\DTO\LogotypeDTO;
use Core\Request\BaseRequestParams;

class LogotypeUpdateRequest extends BaseRequestParams
{
    public function rules()
    {
        return [
            parent::rules(),
            'title'   =>   ['required','string'],
            'path'    =>   ['nullable','image','mimes:png,jpg,jpeg'],
        ];
    }

    public function getDto(): LogotypeDTO
    {
        return new LogotypeDTO([
            'title' => $this->get('title'),
        ]);
    }
}
