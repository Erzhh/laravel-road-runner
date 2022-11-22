<?php

namespace App\Domain\Prices\Maket\Models;

use App\Domain\Prices\Characteristic\Models\Characteristic;
use App\Domain\Prices\Characteristic\Models\CharacteristicsValue;
use Core\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Maket extends BaseModel
{
    protected $fillable = [
        'id',
        'title',
        'image',
        'obj_property',
        'obj_value',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'obj_property' => 'array',
        'obj_value' => 'array',
    ];

    public function characteristics(): HasMany
    {
        return $this->hasMany(Characteristic::class);
    }
}
