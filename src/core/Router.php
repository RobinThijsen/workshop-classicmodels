<?php
declare(strict_types=1);
namespace core;

use controller\AuthController;
use controller\ProductsController;

class Router {

    public function __constructor(): void {}

    /**
     * @param string $uri_path url path
     * @return void
     */
    public function route(string $uri_path): void {
        switch ($uri_path) {
            case "/":
            case "/index":
                $productObj = new ProductsController();
                $productObj->index();
                break;
            case "/login":
                $auth = new AuthController();
                $auth->login($_POST);
                break;
            case "/register":
                $auth = new AuthController();
                $auth->register($_POST);
                break;
            case "/seaarch":
                $productObj = new ProductsController();
                $productObj->search($_POST);
                break;
            case "/profil":
                $auth = new AuthController();
                $auth->profil();
                break;
            case "/productLine":
                $productObj = new ProductsController();
                $productObj->productLine(strip_tags($_GET['productLine']));
                break;
            case "/product":
                $productObj = new ProductsController();
                $productObj->product(strip_tags($_GET['id']));
                break;
            case "/logout":
                $auth = new AuthController();
                $auth->logout();
                break;
            case "/delete":
                $auth = new AuthController();
                $auth->delete();
                break;
            default:
                include_once "views/layout/header.view.php";
                include_once "views/error.view.php";
                include_once "views/layout/footer.view.php";
                break;
        }
    }
}