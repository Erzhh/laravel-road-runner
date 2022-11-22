<?php

namespace App\Domain\Prices\Characteristic\Models;

use Core\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CharacteristicsValue extends BaseModel
{
    protected $table = 'characteristic_values';
    public $timestamps = false;
    protected $fillable = [
        'title',
        'characteristic_id',
    ];

    public function characteristic(): belongsTo
    {
        return $this->belongsTo(Characteristic::class);
    }

}
