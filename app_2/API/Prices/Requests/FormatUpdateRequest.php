<?php

namespace API\Prices\Requests;

use App\Domain\Prices\Format\DTO\FormatDTO;
use Core\Request\BaseRequestParams;
use Illuminate\Validation\Rule;

class FormatUpdateRequest extends BaseRequestParams
{
    protected function prepareForValidation(){
        $this->merge( ['id' => $this->route('format')->id??null] );
    }

    public function rules()
    {
        return [
            parent::rules(),
            'title'   => ['required','string','min:1','max:30'],
            'alias'   => ['required','string','min:1','max:30',
                Rule::unique('formats', 'alias')->ignore($this->input('id'))
            ],
        ];
    }

    public function getData(): FormatDTO
    {
        return new FormatDTO([
            'title' => $this->get('title'),
            'alias' => $this->get('alias'),
        ]);
    }
}
