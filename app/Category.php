<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $category_id;
    public $parent_id;
    public $description;
}
