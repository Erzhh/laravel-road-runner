<?php

namespace Domain\Prices\Bonus\QueryBuilder;

use App\Domain\Prices\Bonus\DTO\BonusDTO;
use Core\Request\DTO\RequestParamsDTO;

class BonusFindByUserUId extends BonusQuery {

    public function __construct(
        private string $uid,
        private RequestParamsDTO $request = new RequestParamsDTO(['fields'=>[],'include'=>[]])
    ){}

    public function run()
    {
         $dto =  new BonusDTO([
            'user_uid' => $this->uid
        ]);

        return  $this->getModel()
                        ->firstOrCreate([
                                'user_uid' => $this->uid
                            ],
                            $dto->toArray()
                        );
    }
}
