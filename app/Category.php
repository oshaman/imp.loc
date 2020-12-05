<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $category_id;
    public $parent_id;
    public $description;

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'category_id')->with(['children']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parents()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getChildren()
    {
        return $this->hasMany(Category::class, 'parent_id', 'category_id');
    }
}
