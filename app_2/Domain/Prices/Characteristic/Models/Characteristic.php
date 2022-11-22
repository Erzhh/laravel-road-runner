<?php

namespace App\Domain\Prices\Characteristic\Models;

use App\Domain\Prices\Maket\Models\Maket;
use Core\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\hasOne;

class Characteristic extends BaseModel
{
    protected $fillable = [
        'property',
        'maket_id',
    ];

    public function values(): HasMany
    {
        return $this->hasMany(CharacteristicsValue::class)->orderBy('title','desc');
    }

    public function products(): HasMany
    {
        return $this->hasMany(CharacteristicsProduct::class);
    }

    public function maket(): hasOne
    {
        return $this->hasOne(Maket::class,'id','maket_id');
    }
}
