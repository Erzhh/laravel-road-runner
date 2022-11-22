<?php

namespace API\Prices\Requests;

use App\Domain\Prices\Bonus\DTO\BonusDTO;
use Core\Request\BaseRequestParams;

class BonusStoreRequest extends BaseRequestParams
{
    public function rules()
    {
        return [
            parent::rules(),
            'bonus'   => ['required','integer','digits_between:0,100'],
            'installment'   => ['required','integer','digits_between:0,100'],
            'visible'   => ['nullable','boolean'],
            'user_uid' => ['required','uuid']
        ];
    }

    public function getDto(): BonusDTO
    {
        return new BonusDTO([
            'bonus' => $this->get('bonus'),
            'installment' => $this->get('installment'),
            'visible' => $this->get('visible'),
            'user_uid' => $this->get('user_uid'),
        ]);
    }
}
