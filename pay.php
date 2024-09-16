<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'data.php';
// if (!isset($_SESSION['user'])) {
//     header('location:login.php');
// }


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
    <link rel="stylesheet" href="./assets/css/grid.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/pay.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="./public/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/all.min.css">
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="shortcut icon" href="./assets/img/panda.png">
    <title>Thanh toán</title>
</head>

<body>
    <!-- Back to top -->

    <!-- Background -->
    <?php include 'header.php' ?>
    <div class="app-booking">

        <div class="pay">
            <div class="grid wide">
                <div class="pay__content">
                    <h1 class="pay__content-title">Thông tin vé xem phim</h1>
                    <div class="pay__content-movie-wrapper">
                        <div class="pay__content-movie l-6 m-12">
                            <div class="pay-movie-row">
                                <p class="pay-movie-title l-4">Phim</p>
                                <p class="pay-movie-about pay-movie-name">...</p>
                            </div>
                            <div class="pay-movie-row">
                                <p class="pay-movie-title l-4">Suất chiếu</p>
                                <p class="pay-movie-about pay-movie-time">...</p>
                            </div>
                            <div class="pay-movie-row">
                                <p class="pay-movie-title l-4">Rạp</p>
                                <p class="pay-movie-about pay-movie-address">...</p>
                            </div>
                            <div class="pay-movie-row">
                                <p class="pay-movie-title l-4">Phòng</p>
                                <p class="pay-movie-about pay-movie-position">...</p>
                            </div>
                            <div class="pay-movie-row">
                                <p class="pay-movie-title l-4">Ghế</p>
                                <p class="pay-movie-about pay-movie-seats">...</p>
                            </div>
                        </div>
                        <div class="pay__content-seri-wrapper l-6 m-12">
                            <div class="pay__content-seri">
                                <img src="./assets/img/code.png" alt="seri">
                            </div>
                            <p class="pay__content-seri-number">6 5 4 9 8 7 1 3 2 4 6</p>
                        </div>
                    </div>
                    <div class="pay__content-payment-wrapper">
                        <form class="pay__content-payment-wrapper">
                            <div class="pay__content-payment row">
                                <div class="col l-8 m-12">

                                    <form class="payment-info" action="#" name="form">
                                        <div class="payment-info-row">
                                            <span class="payment-info-title">Tên <br><span class="payment-error" id="name-error"></span></span>

                                            <div class="payment-info-form">
                                                <input type="text" class="payment-info-form-input" id="paymentname" required placeholder=" " value="<?php echo $_SESSION['user']['name'] ?>">
                                                <label for="name" class="payment-info-form-label">Tên / Name</label>
                                            </div>

                                        </div>
                                        <div class="payment-info-row">
                                            <span class="payment-info-title">Số điện thoại <br><span class="payment-error" id="phone-error"></span></span>
                                            <div class="payment-info-form">
                                                <input type="text" class="payment-info-form-input" id="paymentphone" required placeholder=" " value="<?php echo $_SESSION['user']['phone_number'] ?>">
                                                <label for="name" class="payment-info-form-label">Số điện thoại / Phone number</label>
                                            </div>

                                        </div>
                                        <div class="payment-info-row">
                                            <span class="payment-info-title">Ghi chú</span></span>
                                            <div class="payment-info-form">
                                                <input type="text" class="payment-info-form-input" id="paymentnote" placeholder=" ">
                                                <label for="name" class="payment-info-form-label">Ghi chú / Note</label>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="payment-method-container">
                                        <div class="payment-method-wrapper">
                                            <p class="payment-method-title">Phương thức thanh toán <br><span class="payment-error" id="bank-error"></span></p>
                                            <div class="payment-method-bank-wrapper">

                                                <label for="bidv" class="payment-method-bank-label">
                                                    <div class="payment-method-img-wrapper">
                                                        <img src="https://bom.so/UjtdaY" alt="" class="payment-method-img">
                                                    </div>
                                                    <span class="payment-method-bank">
                                                        BIDV
                                                    </span>
                                                    <input id="bidv" type="radio" class="option-input radio" name="example" required>
                                                </label>
                                                <label for="agribank" class="payment-method-bank-label">
                                                    <div class="payment-method-img-wrapper">
                                                        <img src="https://bom.so/EM6LuW" alt="" class="payment-method-img">
                                                    </div>
                                                    <span class="payment-method-bank">
                                                        Agribank
                                                    </span>
                                                    <input id="agribank" type="radio" class="option-input radio" name="example">
                                                </label>

                                                <label for="momo" class="payment-method-bank-label">
                                                    <div class="payment-method-img-wrapper">
                                                        <img src="https://seeklogo.com/images/M/momo-logo-ED8A3A0DF2-seeklogo.com.png" alt="" class="payment-method-img">
                                                    </div>
                                                    <span class="payment-method-bank">
                                                        Momo
                                                    </span>
                                                    <input id="momo" type="radio" class="option-input radio" name="example">
                                                </label>

                                                <label for="zalopay" class="payment-method-bank-label">
                                                    <div class="payment-method-img-wrapper">
                                                        <img src="https://bom.so/L2AS6a" alt="" class="payment-method-img">
                                                    </div>
                                                    <span class="payment-method-bank">
                                                        Zalo Pay
                                                    </span>
                                                    <input id="zalopay" type="radio" class="option-input radio" name="example">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col l-4 m-12">
                                    <div class="payment-total-container">
                                        <div class="payment-total-wrapper">
                                            <div class="payment-total-content">
                                                <div class="payment-total-row">
                                                    <p class="payment-total-title">Giá vé</p>
                                                    <p class="payment-total-price price-ticket"></p>
                                                </div>
                                                <div class="payment-total-row">
                                                    <p class="payment-total-title">Giảm giá</p>
                                                    <p class="payment-total-price price-offer"></p>
                                                </div>

                                                <div class="payment-total-horizon"></div>

                                                <div class="payment-total-last-row">
                                                    <p class="payment-total-last-tite">Tổng</p>
                                                    <div class="payment-total-last-price"></div>
                                                </div>

                                                <div class="payment-total-btn-wrapper">
                                                    <button type="submit" class="payment-total-btn imediate">
                                                        Thanh toán
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>

                <div class="pay-modal js-pay-modal">
                    <div class="pay-modal-container js-pay-modal-container">
                        <div class="modal-left l-6 s-12">
                            <div class="modal-left-heading">
                                <div class="left-heading-img">
                                    <img src="https://cdn.galaxycine.vn/media/2024/5/9/stalker-500_1715240711738.jpg" alt="7vien">
                                </div>
                                <div class="left-heading-info">
                                    <p class="left-heading-name">Bảy viên ngọc rồng siêu cấp</p>
                                </div>
                            </div>
                            <div class="left-body">
                                <div class="left-body-info">
                                    <div class="modal-info-title">thời gian</div>
                                    <div class="modal-info-about time-info">19:00</div>
                                </div>
                                <div class="left-body-info">
                                    <div class="modal-info-title">ngày chiếu</div>
                                    <div class="modal-info-about day-info">19:00</div>
                                </div>
                                <div class="left-body-info">
                                    <div class="modal-info-title">loại</div>
                                    <div class="modal-info-about">2D</div>
                                </div>

                                <div class="left-body-info-last">
                                    <div class="modal-info-title">Rạp</div>
                                    <div class="modal-info-about address-info">HowT Nguyễn Kiệm</div>
                                </div>

                                <div class="modal-btn-wrapper">
                                    <input type="button" class="modal-btn l-8" value="Thanh toán"></input>
                                </div>
                            </div>
                        </div>
                        <div class="modal-right l-6 s-12">
                            <p class="pay-modal-header">
                                Thanh Toán Thành Công! Chúc quý khách xem phim vui vẻ.
                            </p>
                            <div class="pay-modal-qrcode-wrapper">
                                <div class="pay-modal-qrcode">
                                    <div class="pay-modal-qrcode-background">
                                        <img src="./assets/img/QRcode.png" alt="QRcode" class="pay-modal-qrcode-img">
                                    </div>
                                </div>
                            </div>
                            <div class="pay-modal-title">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="jsx-2d0bf11af0f1d0b9 inline w-6 h-6 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" class="jsx-2d0bf11af0f1d0b9"></path>
                                </svg>
                                Quét QR code để biết thêm chi tiết.
                            </div>
                            <div class="pay-close"><i class="fa-solid fa-xmark"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </footer>
    </div>

    <!-- Javascript -->
    <script src="./assets/js/pay.js"></script>
    <script src="./assets/js/base.js"></script>
    <?php include 'footer.php' ?>
</body>

</html>