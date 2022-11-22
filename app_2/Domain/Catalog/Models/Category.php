<?php

namespace Domain\Catalog\Models;

use App\Domain\Prices\Format\Models\Format;
use App\Domain\Prices\Logotype\Models\Logotype;
use Core\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $parent_id
 * @property int $status
 * @property string $uid
 * @property string $name
 * @property string $code
 */
class Category extends BaseModel
{
    use SoftDeletes,HasFactory;

    protected $fillable = [
        'uid',
        'parent_id' ,
        'name',
        'code',
        'status'
    ];

    public function scopeIsPartent($query){
        return $query->whereNULL('parent_id');
    }

    public function children()
    {
       return $this->hasMany(Category::class,'parent_id')->with('children');
    }

    public function children_without_recursion()
    {
        return $this->hasMany(Category::class,'parent_id');
    }

    public function parent(){
        return $this->hasOne(Category::class,'id','parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class,'category_id');
    }

    public function formats()
    {
        return $this->belongsToMany(Format::class,'formats_categories','category_uid','format_id','uid');
    }

    public function logotypes()
    {
        return $this->belongsToMany(Logotype::class,'logotypes_categories','category_uid','logotype_id','uid','id');
    }

}
