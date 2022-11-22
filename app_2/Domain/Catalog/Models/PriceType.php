<?php

namespace Domain\Catalog\Models;

use Core\BaseModel;

class PriceType extends BaseModel
{
    protected $table = 'price_types';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'code',
        'uid',
        'status'
    ];

    protected $attributes = [
        'status' => 1,
    ];
}
