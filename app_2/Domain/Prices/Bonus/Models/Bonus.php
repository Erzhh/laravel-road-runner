<?php

namespace App\Domain\Prices\Bonus\Models;

use App\Domain\Access\User\Models\User;
use Core\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bonus extends BaseModel
{
    protected $fillable = [
        'bonus',
        'installment',
        'visible',
        'user_uid'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class,'user_uid','uid');
    }

}
