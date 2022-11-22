<?php

namespace Domain\Settings\Errors\Models;

use App\Domain\Access\User\Models\User;
use Core\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property int $user_id
 * @property int $status
 * @property string $message
 * @property object $data
 * @property string $is_send_me
 */
class Error extends BaseModel
{
    protected $table = 'errors';

    protected $fillable = [
        'id',
        'user_id',
        'status',
        'message',
        'data',
        'is_send_me',
        'created_at',
        'updated_at'
    ];

    public function user():HasOne
    {
        return $this->hasOne(User::class,'id','user_id');
    }

}
