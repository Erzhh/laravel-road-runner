<?php

namespace Domain\Catalog\Models;

use App\Domain\Prices\Characteristic\Models\CharacteristicsProduct;
use App\Domain\Prices\Format\Models\Format;
use App\Domain\Prices\Printed\Models\PriceHistoryPrinted;
use Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * @property integer $id
 * @property string $uid
 * @property integer|null $category_id
 * @property string $name
 * @property string $code
 */
class Product extends BaseModel
{
    use SoftDeletes,HasFactory;

    protected $fillable = [
        'uid',
        'category_id',
        'full_name',
        'name',
        'code',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function characteristic_product(): HasMany
    {
        return $this->hasMany(CharacteristicsProduct::class,'product_uid','uid')->orderBy('order','asc');
    }

    public function category(): BelongsTo
    {
        return $this->BelongsTo(Category::class);
    }

    public function detail(): HasOne
    {
        return $this->hasOne(ProductDetail::class);
    }

    public function price(): HasOne
    {
        return $this->hasOne(Price::class,'product_id','id');
    }

    public function bonus(): HasOne
    {
        return $this->hasOne(ProductBonus::class,'product_uid','uid');
    }

    public function price_history(): HasOne
    {
        return $this->hasOne(PriceHistory::class,'product_uid','uid')->orderBy('id', 'desc')->limit(1);
    }

    public function formats(): BelongsToMany
    {
        return $this->belongsToMany(Format::class,'formats_products','product_uid','format_id','uid');
    }

    public function product(): belongsTo
    {
        return $this->belongsTo(Product::class,'product_uid','uid');
    }

    public function print(): belongsTo
    {
        return $this->belongsTo(PriceHistoryPrinted::class,'uid','history_uid')
                                ->where('user_uid',Auth::user()->uid);
    }


}
