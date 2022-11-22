<?php

namespace Domain\Catalog\Models;

use Core\BaseModel;

/**
 * @property integer $id
 * @property integer $product_uid
 * @property integer|null $bonus
 */
class ProductBonus extends BaseModel
{
    protected $table = 'product_bonuses';
    public $timestamps = false;

    protected $fillable = [
        'product_uid',
        'bonus'
    ];

    public function product()
    {
        return $this->BelongsTo(Product::class,'product_uid','uid');
    }

}
