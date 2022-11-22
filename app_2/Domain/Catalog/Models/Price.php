<?php

namespace Domain\Catalog\Models;

use Core\BaseModel;

class Price extends BaseModel
{
    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'warehouse_id',
        'product_id',
        'quality_id',
        'price_type_id',
        'cost',
    ];

    public function product()
    {
        return $this->BelongsTo(Product::class);
    }

}
