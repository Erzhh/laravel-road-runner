<?php

namespace App\Domain\Prices\Characteristic\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class CharacteristicSimilarDTO extends DataTransferObject {

    public array $uids = [];
    public string $product_uid = '';

    public function uuids(): array
    {
        return $this->uids;
    }

    public function getProduct():string
    {
        return $this->product_uid;
    }

    public function countUids():int
    {
        return count($this->uids);
    }

}
