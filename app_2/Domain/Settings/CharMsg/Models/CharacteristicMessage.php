<?php

namespace App\Domain\Settings\CharMsg\Models;

use Core\BaseModel;
use Domain\Catalog\Models\Product;
use Illuminate\Database\Eloquent\Relations\HasOne;


class CharacteristicMessage extends BaseModel
{
    public $timestamps = true;

    protected $fillable = [
        'user_name',
        'product_uid' ,
        'is_view',
        'data'
    ];

    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'uid','product_uid');
    }
}
