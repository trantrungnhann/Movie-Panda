<?php
include 'data.php';
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $index = array_search($id, $_SESSION['cartgory']);
    unset($_SESSION['cartgory'][$index]);
    header('location: cartgory.php');
}

$histories = $billModel->getBillsByUser($_SESSION['user']['id']);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/all.min.css">
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="shortcut icon" href="./assets/img/panda.png">
    <title>Lịch sử mua hàng</title>
</head>

<body>
    <?php include 'header.php' ?>
    <div class="container">
        <table class="table table-dark mt-5">
            <thead>
                <tr>
                    <th scope="col">Ngày đặt vé</th>
                    <th scope="col">Tên Phim</th>
                    <th scope="col">Số ghế</th>
                    <th scope="col">Rạp</th>
                    <th scope="col">Thời gian bắt đầu</th>
                    <th scope="col">Tổng tiền</th>
                </tr>
            </thead>
            <?php
            if (isset($histories)) { ?>
                <?php
                foreach ($histories as $bill) {
                ?>
                    <thead>
                        <tr>
                            <td scope="col"><?php echo $bill['created_at'] ?></td>
                            <td scope="col"><?php echo $bill['name'] ?></td>
                            <td scope="col"><?php echo $bill['seats'] ?></td>
                            <td scope="col"><?php echo $bill['address'] ?></td>
                            <td scope="col"><?php echo $bill['timePay'] ?></td>
                            <td scope="col"><?php echo $bill['totalPrice'] ?></td>
                        </tr>
                    </thead>
                <?php } ?>
            <?php } ?>
        </table>
    </div>
    <!-- footer -->
    <?php include 'footer.php' ?>
    <script src="./public/js/bootstrap.bundle.min.js"></script>
    <script src="./public/js/app.js"></script>
</body>

</html>