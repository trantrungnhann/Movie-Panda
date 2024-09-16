<?php
session_start();
// require_once __DIR__ . './config/database.php';
// autoloading
// spl_autoload_register(function ($className) {
//     require_once __DIR__ . "./models/" . $className . ".php";
// });
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/models/Model.php';
require_once __DIR__ . '/models/CartModel.php';
require_once __DIR__ . '/models/CategoryModel.php';
require_once __DIR__ . '/models/ProductModel.php';
require_once __DIR__ . '/models/UserModel.php';
require_once __DIR__ . '/models/BillModel.php';
$billModel = new BillModel();
$productModel = new ProductModel();
$userModel = new UserModel();
$categoryModel = new CatGoryModel();
$products = $productModel->getProducts();
$productsLimit = $productModel->getProducts(6);
$categories = $categoryModel->getAllCatgory();
