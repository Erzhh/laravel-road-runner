<?php

namespace Domain\Catalog\Dto;

use Spatie\DataTransferObject\DataTransferObject;

class ProductBonusDto extends  DataTransferObject {

    public int $product_uid;
    public int $bonus;

}
