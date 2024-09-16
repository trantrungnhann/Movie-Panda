<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include 'data.php';
$notication = "";
if (isset($_SESSION['user']['name'])) {
    header('location:index.php');
}
if (isset($_POST['username']) && isset($_POST['password'])) {
    $user = $userModel->login($_POST['username'], $_POST['password']);
    if ($user != null) {
        $_SESSION['user'] = $user;
        header('location:index.php');
    } else {
        $notication = "<p style='color:red'>Incorrect account or password!</p>";
    }
}

//[{id:"", product_name:"",product_description:""...}]
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/all.min.css">
    <link rel="stylesheet" href="./public/css/styleLogin.css">
    <link rel="shortcut icon" href="./assets/img/panda.png">
    <title>Đăng nhập</title>
</head>

<body>
    <form action="" method="post">
        <h1>Login</h1>
        <div class="input-group">
            <input type="text" id="username" name="username" required />
            <label for="username">Phone number</label>
        </div>

        <div class="input-group">
            <input type="password" id="password" name="password" autocomplete="new-password" required />
            <label for="password">Password</label>
        </div>
        <?php if (isset($notication)) {
            echo $notication;
        } ?>
        <button type="submit">Login</button>
        <p>Don't have account? <a href="./register.php">Sign Up</a></p>
    </form>
</body>

</html>