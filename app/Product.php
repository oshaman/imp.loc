<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public function getViewPriceAttribute()
    {
        return number_format($this->price, 2, '.', ' ');
    }
}
