<?php

namespace Domain\Catalog\Models;

use App\Domain\Access\User\Models\User;
use App\Domain\Prices\Printed\Models\PriceDocumentPrinted;
use App\Domain\Prices\Printed\Models\PriceHistoryPrinted;
use Core\BaseModel;
use Illuminate\Support\Facades\Auth;

class PriceDocument extends BaseModel
{
    protected $table = 'price_documents';

    protected $fillable = [
        'id',
        'uid',
        'name',
        'number',
        'user_id',
        'user_name',
    ];

    protected $hidden = [
        'deleted_at',
        'update_at',
    ];

    protected $casts = [
        'created_at' => 'datetime', // Change your format
    ];

    public function user()
    {
        return $this->BelongsTo(User::class);
    }

    public function print(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(PriceDocumentPrinted::class,'price_document_uid','uid')
                    ->where('user_uid',Auth::user()->uid);
    }

    public function histories()
    {
        return $this->hasMany(PriceHistory::class,'doc_id','id');
    }

}
