<?php

namespace App\Http\Controllers;

use App\Category;
use App\Moyo;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class MainController extends Controller
{
    protected $product_repo;

    public function __construct(ProductRepository $productRepository)
    {
        $this->product_repo = $productRepository;
    }

    public function index(Request $request, Category $category)
    {
        $categories = Category::where(['parent_id' => 0])->with('children')->get();
//        dd($category->category_id);
        $seo = 'testttt';

        $products = $this->product_repo->getProducts(['category' => $category]);

        return view('main.index')->with(compact('products', 'seo', 'categories'));
    }


    public function importTest()
    {
        $start = microtime(1);

        try {
            $moyo = new Moyo();

            $data = $moyo->getData();

//            $cats = $moyo->getCategories($data);
            $offers = $moyo->getOffers($data);

//            DB::table('categories')->insertOrIgnore($cats);

            foreach (array_chunk($offers, 3000) as $value) {
                DB::table('products')->insertOrIgnore($value);
            }

            $stop = microtime(1);
            Log::info('time ====+++++++++==> ' . ($stop - $start) . PHP_EOL);

        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
    }


}
