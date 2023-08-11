<?php
declare(strict_types=1);
namespace controller;

use Exception;
use models\Product;

class ProductsController extends Product
{

    /**
     * display all product limited by 20
     * @return void
     */
    public function index(): void
    {
        try {
            $limit = "20";
            if (!empty($_GET) && isset($_GET['limit'])) $limit = strip_tags($_GET['limit']);
            $products = Product::getProducts((int) $limit);

            include_once "views/layout/header.view.php";
            include_once "views/index.view.php";
            include_once "views/layout/footer.view.php";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * display result of user's request
     * @param string $productCode code of product search by user
     * @return void
     */
    public function product(string $productCode): void
    {
        try {
            $productInfo = Product::getProductById($productCode);

            include_once "views/layout/header.view.php";
            include_once "views/product.view.php";
            include_once "views/layout/footer.view.php";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * display result of research
     * @param array $post value of the research
     * @return void
     */
    public function search(array $post): void
    {
        try {
            $products = Product::getProductsByName(strip_tags($_POST['search']));

            include_once "views/layout/header.view.php";
            include_once "views/search.view.php";
            include_once "views/layout/footer.view.php";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function productLine(string $productLine): void
    {
        try {
            $limit = "20";
            if (!empty($_GET) && isset($_GET['limit'])) $limit = strip_tags($_GET['limit']);
            $products = Product::getProductsAndCountByProductLine($productLine, (int) $limit);
            $count = $products['count'];

            include_once "views/layout/header.view.php";
            include_once "views/productLine.view.php";
            include_once "views/layout/footer.view.php";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}