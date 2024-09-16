<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'data.php';
if (!isset($_SESSION['user'])) {
    header('location:login.php');
}

if (isset($_POST['productId'])) {

    if ($productModel->checkLike($_POST['productId'], $_SESSION['user']['id'])) {
        $productModel->removeLike($_POST['productId'], $_SESSION['user']['id']);
    } else {
        $productModel->addLike($_POST['productId'], $_SESSION['user']['id']);
    }
}

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $id = $_GET['id'];
    if (isset($_POST['content'])) {
        if (!isset($_SESSION['user'])) {
            header('location:login.php');
        }
        $productModel->addComment($id, $_SESSION['user']['id'], $_POST['content']);
    }
    if (!isset($_POST['productId']) && !isset($_POST['content'])) {
        $productModel->updateProductView($id);
    }
    $product = $productModel->getProductByID($id);
    if (!$product) {
        header('location:index.php');
    }
    $comments = $productModel->getComment($id);
} else {
    header('location:index.php');
}

if (isset($_POST['idRemove'])) {
    $productModel->deleteProduct($_POST['idRemove']);
    header('location:index.php');
}

if (empty($_SESSION['cartgory'])) {
    $_SESSION['cartgory'] = [];
}

if (isset($_GET['idcart'])) {
    $idcart = $_GET['idcart'];
    if (array_search($id, $_SESSION['cartgory']) == []) {
        array_push($_SESSION['cartgory'], $idcart);
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/booking.css">
    <link rel="stylesheet" href="./assets/css/grid.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <link rel="stylesheet" href="./public/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/all.min.css">
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="shortcut icon" href="./assets/img/panda.png">
    <title><?php echo $product['name'] ?></title>
</head>

<body>
    <!-- header -->
    <?php include 'header.php' ?>
    <div class="container mt-5">

        <!-- booking -->

        <div class="app-booking">

            <div class="container__booking">
                <div class="booking-slider" style="background-image: url('./public/images/<?php echo $product['banner'] ?>');">
                </div>
                <div id="seat-booking" class="booking-wrapper" data-price="<?php echo $product['price'] ?>">
                    <div class="grid wide">
                        <div class="row no-gutters">
                            <div class="col-12 col-sm-12 col-md-3">
                                <div class="booking-pay">
                                    <div class="booking-pay-wrapper">
                                        <div class="booking-pay__content">
                                            <div class="booking-pay-data">
                                                <p class="booking-pay-data-header">Vé</p>
                                                <p class="booking-pay-data-content ticket-selected">Đã chọn</p>
                                                <p class="booking-pay-data-content ticket-normal">Thường</p>
                                                <p class="booking-pay-data-content ticket-vip">Vip</p>
                                                <p class="booking-pay-data-content your-selected">Ghế bạn chọn</p>
                                            </div>
                                            <div class="booking-payment">
                                                <p class="your-seat">Chỗ ngồi <span id="seat-selected"></span><a href="#seat-booking" id="del-all"><i class="fa-solid fa-xmark"></i></a> </p>
                                                <p class="booking-payment-total">Tổng <span id="total-price"></span></p>
                                            </div>
                                            <div class="booking-pay__commit">
                                                <a href="pay.php" class="booking-pay__commit-btn">Thanh toán</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-9">
                                <div class="seat-book-wrapper">
                                    <div class="seat__container">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="screen">
                                                    <p class="screen-text">
                                                        Screen
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="seats">
                                                    <!-- Js create -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- footer -->
    <?php include 'footer.php' ?>
    <script src="./public/js/bootstrap.bundle.min.js"></script>
    <script src="./public/js/app.js"></script>
    <script src="./assets/js/booking.js"></script>
</body>

</html>