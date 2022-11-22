<?php

namespace App\Domain\Prices\Printed\Models;

use App\Domain\Access\User\Models\User;
use Core\BaseModel;
use Domain\Catalog\Models\PriceDocument;
use Domain\Catalog\Models\PriceHistory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PriceHistoryPrinted extends BaseModel
{
    protected $table = 'price_history_printed';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'document_uid',
        'history_uid',
        'user_uid',
    ];

    public function document(): belongsTo
    {
        return $this->belongsTo(PriceDocument::class,'document_uid','uid');
    }

    public function history(): belongsTo
    {
        return $this->belongsTo(PriceHistory::class,'history_uid','product_uid');
    }

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class,'user_uid','uid');
    }

}
