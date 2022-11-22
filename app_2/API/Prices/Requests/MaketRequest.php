<?php

namespace API\Prices\Requests;

use App\Domain\Prices\Maket\DTO\MaketsDTO;
use Core\Request\BaseRequestParams;

class MaketRequest extends BaseRequestParams
{
    public function rules()
    {
        return [
            parent::rules(),
            'title'   => ['required','string','max:255'],
            'image' => ['required','string'],
            'obj_property' => ['required','array'],
            'obj_value' => ['required','array']
        ];
    }

    public function getDto(): MaketsDTO
    {
        return new MaketsDTO([
            'title' => $this->get('title'),
            'image' => $this->get('image'),
            'obj_property' => $this->get('obj_property'),
            'obj_value' => $this->get('obj_value'),
        ]);
    }
}
