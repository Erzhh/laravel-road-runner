<?php

namespace App\Domain\Prices\Printed\Models;

use App\Domain\Access\User\Models\User;
use Core\BaseModel;
use Domain\Catalog\Models\PriceDocument;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PriceDocumentPrinted extends BaseModel
{
    protected $table = 'price_document_printed';
    public $timestamps = false;

    protected $fillable = [
        'price_document_uid',
        'user_uid',
    ];

    public function document(): belongsTo
    {
        return $this->belongsTo(PriceDocument::class,'price_document_uid','uid');
    }

    public function histories()
    {
        return $this->hasMany(PriceHistoryPrinted::class,'document_uid','price_document_uid');
    }

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class,'user_uid','uid');
    }

}
