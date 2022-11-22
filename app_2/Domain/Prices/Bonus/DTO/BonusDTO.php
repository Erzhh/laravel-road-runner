<?php

namespace App\Domain\Prices\Bonus\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class BonusDTO extends DataTransferObject {

    public int $bonus = 5;
    public int $installment = 12;
    public bool $visible = true;
    public string $user_uid;

}
