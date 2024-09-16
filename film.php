<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'data.php';
$userId = "-1";
if (isset($_SESSION['user'])) {

    $userId = $_SESSION['user']['id'];
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
    $category = $categoryModel->getCatgoryByID($product['category_id']);
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
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Oswald&family=Roboto&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/grid.css">
    <link rel="stylesheet" href="./assets/css/film.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <link rel="shortcut icon" href="./assets/img/panda.png">
    <link rel="stylesheet" href="./public/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/all.min.css">
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="shortcut icon" href="./assets/img/panda.png">
    <title><?php echo $product['name'] ?></title>
</head>

<body>
    <!-- header -->
    <?php include 'header.php' ?>
    <!-- Back to top -->
    <div class="app">
        <!-- Container -->
        <div class="container-page1">
            <div class="content">
                <div class="content-info" style="background-image: url(./public/images/<?php echo $product['banner']; ?>);">
                    <div class="infor__trailer-wrapper">
                        <a onclick="viewTrailerJs('<?php echo $product['trailer'] ?>');" href="#trailer" class="infor__trailer-play-btn film-trailer-item trailer-btn-responsive">
                            <i class="fa-solid fa-play"></i>
                        </a>
                    </div>
                    <div class="infor__name">
                        <img class="infor__name-img" src="./public/images/<?php echo $product['image'] ?>" alt="">
                    </div>
                </div>
            </div>

            <div class="container mt-5">
                <div class="row">
                    <div class='col-lg-5'>
                        <a class='card-item-film' href='#'>
                            <div class='img-item' style='background-image: url(./public/images/<?php echo $product['image'] ?>)'>
                                <div class="info_detail">
                                    <div><span class="badge btn-light border border-2 border-info text-info user-select-none"><i class="fa-regular fa-eye"></i> <?php echo $product['product_view'] ?></span>
                                    </div>
                                    <div>
                                        <?php
                                        if (isset($_SESSION['user'])) {
                                        ?>
                                            <form method="post">
                                                <input type="hidden" name="productId" value="<?php echo $product['id'] ?>">

                                                <button type="submit" class="btn-like badge btn <?php if ($productModel->checkLike($product['id'],  $_SESSION['user']['id'])) {
                                                                                                    echo "btn-danger text-light";
                                                                                                } else {
                                                                                                    echo " text-danger";
                                                                                                } ?> border border-2 border-danger "><i class="fa-regular fa-heart"></i> <?php echo $productModel->countLike($product['id']) ?></button>
                                            </form>
                                        <?php
                                        } else { ?>
                                            <button class="btn-like badge btn border border-2 border-danger text-danger"><i class="fa-regular fa-heart"></i> <?php echo $productModel->countLike($product['id']) ?></button>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-7">
                        <div class="d-flex flex-column">
                            <a class='btn btn-primary btn-block mb-4 p-3' href='film.php?id=<?php echo $product['id'] ?>&idcart=<?php echo $product['id'] ?>'>Add to cart</a>
                            <?php
                            if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 'admin') { ?>
                                <a class='btn btn-warning btn-block mb-4 p-3' href='edit_product.php?id=<?php echo $product['id'] ?>'>Edit</a>
                                <form class="form-group" action="" method="post">
                                    <input type="hidden" name="idRemove" value="<?php echo $id ?>">
                                    <button type="submit" class='form-control btn btn-danger btn-block mb-4 p-3' onclick="return confirm('Do you want to delete this?')">Delete</button>
                                </form>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="detail__infor">
                            <div class="row no-gutters">
                                <div class="col-12">
                                    <div class="detail__infor-wrapper">
                                        <p class="detail__infor-name"><?php echo $product['name'] ?></p>
                                        <p class="detail__infor-kind">
                                            <span class="detail__infor-type">Thể loại: <?php echo $category['name'] ?></span>
                                            <br>
                                            Thời lượng: <?php echo $product['timer'] ?> phút
                                            <br>
                                            Giá vé thường: <?php echo $product['price'] ?>
                                            <br>
                                            Giá vé VIP: <?php echo ceil($product['price'] * (100 / 80)) ?>
                                        </p>
                                        <div class="detail__infor-score">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="32" viewBox="0 0 64 32" version="1.1" class="jsx-f9389667183552d6 w-11">
                                                <g fill="#F5C518" class="jsx-f9389667183552d6">
                                                    <rect x="0" y="0" width="100%" height="100%" rx="4" class="jsx-f9389667183552d6"></rect>
                                                </g>
                                                <g transform="translate(8.000000, 7.000000)" fill="#000000" fill-rule="nonzero" class="jsx-f9389667183552d6">
                                                    <polygon points="0 18 5 18 5 0 0 0" class="jsx-f9389667183552d6"></polygon>
                                                    <path d="M15.6725178,0 L14.5534833,8.40846934 L13.8582008,3.83502426 C13.65661,2.37009263 13.4632474,1.09175121 13.278113,0 L7,0 L7,18 L11.2416347,18 L11.2580911,6.11380679 L13.0436094,18 L16.0633571,18 L17.7583653,5.8517865 L17.7707076,18 L22,18 L22,0 L15.6725178,0 Z" class="jsx-f9389667183552d6"></path>
                                                    <path d="M24,18 L24,0 L31.8045586,0 C33.5693522,0 35,1.41994415 35,3.17660424 L35,14.8233958 C35,16.5777858 33.5716617,18 31.8045586,18 L24,18 Z M29.8322479,3.2395236 C29.6339219,3.13233348 29.2545158,3.08072342 28.7026524,3.08072342 L28.7026524,14.8914865 C29.4312846,14.8914865 29.8796736,14.7604764 30.0478195,14.4865461 C30.2159654,14.2165858 30.3021941,13.486105 30.3021941,12.2871637 L30.3021941,5.3078959 C30.3021941,4.49404499 30.272014,3.97397442 30.2159654,3.74371416 C30.1599168,3.5134539 30.0348852,3.34671372 29.8322479,3.2395236 Z" class="jsx-f9389667183552d6"></path>
                                                    <path d="M44.4299079,4.50685823 L44.749518,4.50685823 C46.5447098,4.50685823 48,5.91267586 48,7.64486762 L48,14.8619906 C48,16.5950653 46.5451816,18 44.749518,18 L44.4299079,18 C43.3314617,18 42.3602746,17.4736618 41.7718697,16.6682739 L41.4838962,17.7687785 L37,17.7687785 L37,0 L41.7843263,0 L41.7843263,5.78053556 C42.4024982,5.01015739 43.3551514,4.50685823 44.4299079,4.50685823 Z M43.4055679,13.2842155 L43.4055679,9.01907814 C43.4055679,8.31433946 43.3603268,7.85185468 43.2660746,7.63896485 C43.1718224,7.42607505 42.7955881,7.2893916 42.5316822,7.2893916 C42.267776,7.2893916 41.8607934,7.40047379 41.7816216,7.58767002 L41.7816216,9.01907814 L41.7816216,13.4207851 L41.7816216,14.8074788 C41.8721037,15.0130276 42.2602358,15.1274059 42.5316822,15.1274059 C42.8031285,15.1274059 43.1982131,15.0166981 43.281155,14.8074788 C43.3640968,14.5982595 43.4055679,14.0880581 43.4055679,13.2842155 Z" class="jsx-f9389667183552d6"></path>
                                                </g>
                                            </svg>
                                            <span class="detail__infor-score-text">
                                                <?php echo $product['imdb'] ?>/<span>10</span>
                                            </span>
                                        </div>
                                        <div class="detail__infor-story">
                                            <h1 class="detail__infor-story-title">Nội dung</h1>
                                            <p class="detail__infor-story-content">
                                                <?php echo $product['description'] ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <div id="booking" class="film-booking-wrapper">
                    <div class="grid wide">

                        <div id="booking-sch" class="film-booking__schedule">
                            <div class="row">
                                <div class="col-lg-2 col-sm-4 col-md-4">
                                    <div class="film-booking__schedule-film">
                                        <img src="https://img.freepik.com/free-photo/pathway-middle-buildings-dark-sky-japan_181624-43078.jpg?w=1380&t=st=1717075354~exp=1717075954~hmac=8ebea643a89a863d41f197f0b8e1f4398887b015e8e5255ab6f308d2e16bed87" alt="" class="film-booking__schedule-img">
                                    </div>
                                </div>
                                <div class="col-lg-10 col-sm-8 col-md-8">
                                    <div class="film-booking__schedule-wrapper">
                                        <div class="film-booking__days">
                                            <div class="slide-schedule row">
                                                <!-- Js create -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="film-booking__theatre">
                            <div class="row">
                                <div class="col-lg-2 col-sm-12 col-md-4">
                                    <div class="theatre-wrapper">
                                        <div class="theatre__address">
                                            <p class="theatre__address-name">Panda Nguyễn Kiệm</p>
                                            <p class="theare__address-desc">371 Nguyễn Kiệm Phương 3 Gò Vấp</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-sm-12 col-md-8">
                                    <div class="film-booking__time">
                                        <div class="row">
                                            <div class="col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper film-booking__time-text" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Nguyễn Kiệm">8:00</a>
                                            </div>
                                            <div class="col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper film-booking__time-text" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Nguyễn Kiệm">9:10</a>
                                            </div>
                                            <div class="col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper film-booking__time-text" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Nguyễn Kiệm">10:40</a>
                                            </div>
                                            <div class="col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper film-booking__time-text" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Nguyễn Kiệm">15:00</a>
                                            </div>
                                            <div class="col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper film-booking__time-text" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Nguyễn Kiệm">19:00</a>
                                            </div>
                                            <div class="col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper film-booking__time-text" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Nguyễn Kiệm">20:00</a>
                                            </div>
                                            <div class="col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper film-booking__time-text" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Nguyễn Kiệm">21:20</a>
                                            </div>
                                            <div class="col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper film-booking__time-text" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Nguyễn Kiệm">22:30</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="film-booking__theatre">
                            <div class="row">
                                <div class="col-lg-2 col-sm-12 col-md-4">
                                    <div class="theatre-wrapper">
                                        <div class="theatre__address">
                                            <p class="theatre__address-name">Panda Bùi Viện</p>
                                            <p class="theare__address-desc">Phạm Ngũ Lão, Quận 1</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-sm-12 col-md-8">
                                    <div class="film-booking__time">
                                        <div class="row ">
                                            <div class="col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Bùi Viện">8:30</a>
                                            </div>
                                            <div class="col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Bùi Viện">9:40</a>
                                            </div>
                                            <div class="col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Bùi Viện">10:45</a>
                                            </div>
                                            <div class="col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Bùi Viện">12:30</a>
                                            </div>
                                            <div class="col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Bùi Viện">15:15</a>
                                            </div>
                                            <div class="col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Bùi Viện">17:25</a>
                                            </div>
                                            <div class="col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Bùi Viện">19:10</a>
                                            </div>
                                            <div class="col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Bùi Viện">19:30</a>
                                            </div>
                                            <div class="col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Bùi Viện">20:30</a>
                                            </div>
                                            <div class="col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Bùi Viện">21:10</a>
                                            </div>
                                            <div class="col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Bùi Viện">22:00</a>
                                            </div>
                                            <div class="col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Bùi Viện">22:30</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="film-booking__theatre">
                            <div class="row">
                                <div class="col-lg-2 col-sm-12 col-md-4">
                                    <div class="theatre-wrapper">
                                        <div class="theatre__address">
                                            <p class="theatre__address-name">Panda Vincom Thủ Đức</p>
                                            <p class="theare__address-desc">Tầng 5, TTTM Vincom Thủ Đức</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-sm-12 col-md-8">
                                    <div class="film-booking__time">
                                        <div class="row ">
                                            <div class="col--6 col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Vincom Thủ Đức">08:30</a>
                                            </div>
                                            <div class="col--6 col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Vincom Thủ Đức">09:45</a>
                                            </div>
                                            <div class="col--6 col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Vincom Thủ Đức">11:00</a>
                                            </div>
                                            <div class="col--6 col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Vincom Thủ Đức">12:35</a>
                                            </div>
                                            <div class="col--6 col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Vincom Thủ Đức">14:10</a>
                                            </div>
                                            <div class="col--6 col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Vincom Thủ Đức">15:15</a>
                                            </div>
                                            <div class="col--6 col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Vincom Thủ Đức">16:45</a>
                                            </div>
                                            <div class="col--6 col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Vincom Thủ Đức">17:10</a>
                                            </div>
                                            <div class="col--6 col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Vincom Thủ Đức">19:00</a>
                                            </div>
                                            <div class="col--6 col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Vincom Thủ Đức">19:45</a>
                                            </div>
                                            <div class="col--6 col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Vincom Thủ Đức">20:30</a>
                                            </div>
                                            <div class="col--6 col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Vincom Thủ Đức">21:00</a>
                                            </div>
                                            <div class="col--6 col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Vincom Thủ Đức">21:45</a>
                                            </div>
                                            <div class="col--6 col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Vincom Thủ Đức">22:07</a>
                                            </div>
                                            <div class="col--6 col-lg-2 col-sm-4 col-md-3">
                                                <a href="" class="film-booking__time-wrapper" data-id="<?php echo $_GET['id'] ?>" data-user-id="<?php echo $userId ?>" data-address-local="Panda Vincom Thủ Đức">22:30</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- comment -->
            <div class="container comment">
                <section>
                    <div class="my-5 py-5">
                        <div class="row d-flex justify-content-center">
                            <div class="col-12">
                                <div class="card w-100">
                                    <div class="card-body">
                                        <?php
                                        foreach ($comments as $comment) { ?>
                                            <?php $user =  $userModel->getUserByID($comment['user_id']);
                                            if ($user) { ?>
                                                <div>
                                                    <div class="d-flex flex-start align-items-center">
                                                        <div>
                                                            <h6 class="fw-bold text-primary mb-1"><?php echo $user['name']  ?></h6>
                                                            <div class="text-muted small mb-0">
                                                                <?php echo $comment['created_at'] ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="mt-3 mb-4 pb-2" style="border-bottom: 1px solid #eee;">
                                                        <?php echo $comment['content'] ?>
                                                    </p>
                                                </div>
                                            <?php } ?>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                                        <form action="" method="post">
                                            <div class="form-outline w-100">
                                                <textarea class="form-control" name="content" id="textAreaExample" rows="4" style="background: #fff;"></textarea>
                                                <label class="form-label" for="textAreaExample">Message</label>
                                            </div>
                                            <div class="float-end mt-2 pt-1">
                                                <button type="submit" class="btn btn-primary btn-sm">Post comment</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- modal trailer -->
    <div id="product-pop-up" class="modal js-modal">
        <div class="modal-js js-modal-container">
            <div id="trailer" class="film-link">
            </div>
            <div class="modal-close js-modal-close"><i class="fa-solid fa-xmark"></i></div>
        </div>
    </div>
    <?php include 'footer.php' ?>
    <!-- Javascript -->
    <script src="./public/js/bootstrap.bundle.min.js"></script>
    <script src="./public/js/app.js"></script>
    <script src="./assets/js/base.js"></script>
    <script src="./assets/js/film.js"></script>

</body>

</html>