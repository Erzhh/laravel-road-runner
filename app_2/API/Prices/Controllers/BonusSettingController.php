<?php

namespace API\Prices\Controllers;

use API\Prices\Requests\BonusRegularRequest;
use API\Prices\Resources\BonusResources;
use Core\BaseController;
use Domain\Prices\Bonus\QueryBuilder\BonusFindByUserUId;

class BonusSettingController extends BaseController
{

    public function bonus_user(BonusRegularRequest $request, $user_uid): BonusResources
    {
        $bonues = (new BonusFindByUserUId($user_uid, $request->getData() ))->run();

        return new BonusResources($bonues);
    }

}
