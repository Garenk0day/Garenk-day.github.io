<?php

namespace Modules\Shop\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Shop\Database\factories\CategoryFactory;

use App\Traits\UuidTrait;

class Category extends Model
{
    use HasFactory, UuidTrait;


    protected $table = 'shop_categories';

    protected $fillable = [
        'parent_id',
        'slug',
        'name',
    ];
    
    protected static function newFactory()
    {
        return \Modules\Shop\Database\factories\CategoryFactory::new();
    }

    public function children()
    {
        return $this->hasMany('Modules\Shop\app\Models\Category', 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo('Modules\Shop\app\Models\Category', 'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany('Modules\Shop\app\Models\Product', 'shop_categories_products', 'product_id', 'category_id');
    }

    public static function childIDs($parentID = null)
    {
        $categories = Category::select('id', 'name', 'parent_id')
            ->where('parent_id', $parentID)
            ->get();
        
        $childIDs = [];
        if (!empty($categories)) {
            foreach ($categories as $category) {
                $childIDs[] = $category->id;
                $childIDs = array_merge($childIDs, Category::childIDs($category->id));
            }
        }

        return $childIDs;
    }
}
