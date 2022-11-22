<?php

namespace API\Prices\Requests;

use App\Domain\Prices\Format\DTO\FormatDTO;
use Core\Request\BaseRequestParams;

class FormatRequest extends BaseRequestParams
{
    public function rules()
    {
        return [
            parent::rules(),
            'title'   => ['required','string','min:1','max:30'],
            'alias'   => ['required','string','min:1','max:30','unique:formats,alias'],
        ];
    }

    public function getDto(): FormatDTO
    {
        return new FormatDTO([
            'title' => $this->get('title'),
            'alias' => $this->get('alias'),
        ]);
    }
}
