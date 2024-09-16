<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'data.php';
if (isset($_POST['userId'])) {
    $id = $_POST['userId'];
    $index = array_search($id, $_SESSION['cartgory']);
    unset($_SESSION['cartgory'][$index]);
}
$user_Id =  $_POST['userId'];
$product_id = $_POST['filmId'];
$seats = $_POST['seats'];
$timePay = $_POST['timePay'];
$totalPrice = $_POST['totalPrice'];
$address = $_POST['address'];

echo $billModel->addBill($user_Id, $product_id, $seats, $address, $timePay, $totalPrice);
