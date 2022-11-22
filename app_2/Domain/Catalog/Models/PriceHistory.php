<?php

namespace Domain\Catalog\Models;

use Core\BaseModel;

class PriceHistory extends BaseModel
{
    protected $table = 'price_histories';
    public $timestamps = false;

    protected $fillable = [
        'doc_id',
        'product_id',
        'product_uid',
        'price_old',
        'price_new'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function document()
    {
        return $this->BelongsTo(PriceDocument::class,'doc_id');
    }

    public function product()
    {
        return $this->BelongsTo(Product::class,'product_uid','uid');
    }

}
