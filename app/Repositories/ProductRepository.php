<?php


namespace App\Repositories;


use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ProductRepository
{

    protected $model;
    /**
     * ArticlesRepository constructor.
     * @param $product Product
     */
    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    /**
     * @param array $params
     * @return Product
     */
    public function getProducts(Request $request, $params)
    {
        $category = $params['category'];

        $query = Product::select('*');

        if ($request->has('search_product')) {
            $re = '#[^\w\'\sа-яА-ЯёЁіІїЇЄє\-]+#u';

            $string = preg_replace($re, '', $request->get('search_product'));
            $string = substr(preg_replace('#[\s{2,}]#', ' ', $string), 0, 96);
            $query->where('description', 'like', '%' . $string . '%');
        }

        if (!is_null($category->category_id)) {
            $category = $category->load('children');
            $ids = $this->getCategoriesId($category);
            $query->whereIn('category_id', $ids);
        }

        if ($request->has('sort_by')) {
            $query->orderBy('price');
        }


        $products = $query->paginate(10);

        return $products;
    }

    /**
     * @param $category Category
     * @return array
     */
    public function getCategoriesId($category)
    {
        $ids = [];
        if (!empty($category->children)) {
            foreach ($category->children as $child) {
                $ids = array_merge($ids, $this->getCategoriesId($child));
            }
            $ids[] = $category->category_id;
        } else {
            $ids[] = $category->category_id;
        }
        return $ids;
    }

}