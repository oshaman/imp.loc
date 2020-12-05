<?php


namespace App\Repositories;


use App\Category;
use App\Product;

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
    public function getProducts($params)
    {
        $category = $params['category'];

        $query = Product::take(9);

        if (!is_null($category->category_id)) {
            $category = $category->load('children');
            $ids = $this->getCategoriesId($category);

            $query->whereIn('category_id', $ids);
        }

        $products = $query->get();

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