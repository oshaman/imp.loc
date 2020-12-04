<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SimpleXMLElement;

class Moyo extends Model
{

    public function getData()
    {
        $get = file_get_contents(env("MOYO_PATH"));

        $data = new SimpleXMLElement($get);

        return $data;
    }

    public function getCategories($data)
    {
        $res = [];

        foreach ($data->shop->categories->category as $v) {
            $attrs = $v->attributes();
            $cat['parent_id'] = (int)$attrs['parentId'];
            $cat['category_id'] = (int)$attrs['id'];
            $cat['description'] = (string)$v;

            $res[] = $cat;
        }

        return $res;
    }

    public function getOffers($data)
    {
        $res = [];

        foreach ($data->shop->offers->offer as $v) {

            $attrs = $v->attributes();
            $offer['id'] = (int)$attrs['id'];
            $offer['category_id'] = (int)$v->categoryId;
            $offer['code'] = (string)$v->code;
            $offer['delivery'] = (bool)$v->delivery;
            $offer['description'] = (string)$v->description;
            $offer['guarantee'] = (string)$v->guarantee;
            $offer['modified_time'] = date('Y-m-d H:i:s', (string)$v->modified_time);
            $offer['name'] = (string)$v->name;
            $offer['picture'] = (string)$v->picture;
            $offer['currency_id'] = (string)$v->currencyId;
            $offer['price'] = (int)$v->price;
            $offer['stock'] = (string)$v->stock;
            $offer['url'] = (string)$v->url;
            $offer['vendor'] = (string)$v->vendor;

            $res[] = $offer;
        }

        return $res;
    }
}
