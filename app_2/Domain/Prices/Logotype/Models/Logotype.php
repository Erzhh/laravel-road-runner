<?php

namespace App\Domain\Prices\Logotype\Models;

use Core\BaseModel;
use Domain\Catalog\Models\Category;
use Illuminate\Database\Eloquent\SoftDeletes;

class Logotype extends BaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'title',
        'path',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class,'logotypes_categories','logotype_id','category_uid','id','uid');
    }

}
