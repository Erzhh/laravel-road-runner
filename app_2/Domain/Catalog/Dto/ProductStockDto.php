<?php

namespace Domain\Catalog\Dto;

use Spatie\DataTransferObject\DataTransferObject;

class  ProductStockDto extends  DataTransferObject {

    public array $uid;
    public int $warehouse_id;
    public int $quality_id;

}
