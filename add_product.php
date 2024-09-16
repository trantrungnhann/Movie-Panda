<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "data.php";

if ($_SESSION['user']['role'] != 'admin') {
    header('location:login.php');
}

//$id, $name, $description, $price, $image, $category_id, $banner, $imdb, $timer, $trailer
if (isset($_POST['name'])  && isset($_POST['description']) && isset($_POST['price']) && isset($_POST['category_id']) && isset($_POST['imdb']) && isset($_POST['timer']) && isset($_POST['trailer'])) {
    $imageFile = "./public/images/" . $_FILES['image']['name'];
    $bannerFile = "./public/images/" . $_FILES['banner']['name'];
    if (is_uploaded_file($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['banner']['tmp_name']) && move_uploaded_file($_FILES['image']['tmp_name'], $imageFile) && move_uploaded_file($_FILES['banner']['tmp_name'], $bannerFile)) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $image = $_FILES['image']['name'];
        $category_id = $_POST['category_id'];
        $banner = $_FILES['banner']['name'];
        $imdb = $_POST['imdb'];
        $timer = $_POST['timer'];
        $trailer = $_POST['trailer'];
        if ($productModel->addProduct($name, $description, $price, $image, $category_id, $banner, $imdb, $timer, $trailer)) {
            $alert = '<script>
                        alert("add success")
                     </script>';
        } else {
            $alert = '<script>
                        alert("add fail")
                    </script>';
        }
    } else {
        $alert = '<script>
                        alert("add fail")
                    </script>';
    }
} else {
}
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
    <title>Add Product</title>
</head>

<body>
    <!-- header -->
    <?php
    if (isset($alert)) {
        echo $alert;
    }
    include 'header.php';
    ?>
    <div class="container">
        <form class="mt-5" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter movie's name">
            </div>
            <div class="row">
                <div class="form-group col-6">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/png, image/gif, image/jpeg, image/webp">
                </div>
                <div class="form-group col-6">
                    <label for="banner">Banner</label>
                    <input type="file" class="form-control" id="banner" name="banner" accept="image/png, image/gif, image/jpeg, image/webp">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-6">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="add price">
                </div>
                <div class="form-group col-6">
                    <label for="imdb">imdb</label>
                    <input type="number" class="form-control" id="imdb" name="imdb" placeholder="add imdb" min="1" max="10" step="0.1" oninput=(checkMinMax(this))>
                </div>
            </div>
            <div class="row">
                <div class="input-radio col-6">
                    <label for="category">Category</label>
                    <select class="form-control" id="category" name="category_id">
                        <option selected>Choose...</option>
                        <?php
                        foreach ($categories as $category) { ?>
                            <option value=<?php echo  $category['id'] ?>><?php echo $category['name'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-6">
                    <label for="timer">Timer</label>
                    <input type="number" class="form-control" id="timer" name="timer" placeholder="add timer">
                </div>
            </div>

            <div class="form-group">
                <label for="trailer">Trailer</label>
                <input type="text" class="form-control" id="trailer" name="trailer" placeholder="add trailer">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
                <small id="emailHelp" class="form-text text-muted">About from product.</small>
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <!-- footer -->
    <?php include 'footer.php' ?>
    <script src="./public/js/bootstrap.bundle.min.js"></script>
    <script src="./public/js/app.js"></script>
</body>

</html>