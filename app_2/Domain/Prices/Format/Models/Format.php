<?php

namespace App\Domain\Prices\Format\Models;

use Core\BaseModel;
use Domain\Catalog\Models\Product;

class Format extends BaseModel
{
    public $timestamps = false;

    protected $fillable = [
        'id',
        'alias',
        'title'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class,'formats_products','format_id','product_uid','id','uid');
    }

}
