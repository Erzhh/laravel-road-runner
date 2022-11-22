<?php

namespace App\Domain\Prices\Characteristic\Models;

use Core\BaseModel;
use Domain\Catalog\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CharacteristicsProduct extends BaseModel
{
    protected $table = 'characteristics_products';
    protected $fillable = [
        'id',
        'characteristic_id',
        'product_uid',
        'characteristic_value_id',
        'order',
        'is_visible',
        'is_view_text',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'is_view_text' => 'boolean',
    ];

    public function characteristic(): belongsTo
    {
        return $this->belongsTo(Characteristic::class);
    }
    public function product(): belongsTo
    {
        return $this->belongsTo(Product::class,'product_uid','uid');
    }

    public function value(): belongsTo
    {
        return $this->belongsTo(CharacteristicsValue::class,'characteristic_value_id','id');
    }
}
