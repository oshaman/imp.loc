<?php

namespace App\Http\Controllers;

use App\Moyo;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        $seo = 'testttt';

        $products = Product::skip(584)->take(9)->get();

//        dd($products);

//        $products = [1,2,3,4,5,6,7,8,9];
        return view('main.index')->with(compact('products', 'seo'));
    }


    public function importTest()
    {
        $start = microtime(1);

        $moyo = new Moyo();

        $data = $moyo->getData();

//        $cats = $moyo->getCategories($data);
        $offers = $moyo->getOffers($data);

//        DB::table('categories')->insertOrIgnore($cats);

        foreach (array_chunk($offers, 3000) as $value) {
            DB::table('products')->insertOrIgnore($value);
        }


        $stop = microtime(1);

        dd(($stop - $start), $offers);
    }


}
