<?php

namespace Domain\Catalog\Models;

use Core\BaseModel;

/**
 * @property integer $id
 * @property integer|null $product_id
 * @property string $name_kz
 * @property string $name_ru
 * @property string $description
 */
class ProductDetail extends BaseModel
{
    protected $table = 'product_details';
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'product_uid',
        'name_kz',
        'name_ru',
        'description',
        'article'
    ];

    public function product()
    {
        return $this->BelongsTo(Product::class,'product_id','id');
    }

}
