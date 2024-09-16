<?php
function renderCard($product)
{
    $productModel = new ProductModel();
    $categoryModel = new CatGoryModel();
    $category = $categoryModel->getCatgoryByID($product['category_id']);
    // $string  = substr($product['description'], 0, 120);
    $content = "<div class='col-6 col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-5 card-item' data-name='{$product['name']}'>
                <a class='recommend-item' href='film.php?id={$product['id']}' >
                    <div class='img-item' style='background-image: url(./public/images/{$product['image']})'>
                        <div class='info'>
                            <div>
                                <span class='badge border border-2 border-info text-info user-select-none'><i class='fa-regular fa-eye'></i>  {$product['product_view']}</span>
                            </div>";
    if (isset($_SESSION['user'])) {
        $content .= "
                            <div>
                                <form method='post'>
                                    <input type='hidden' name='productId' value='{$product['id']}'>
                                    <input type='hidden' name='userId' value='{$_SESSION['user']['id']}'>
                                    <button type'submit' class='btn-like badge btn";
        if ($productModel->checkLike($product['id'],  $_SESSION['user']['id'])) {
            $content .= " btn-danger text-light";
        } else {
            $content .= " text-danger";
        }
        $content .= " border border-2 border-danger'><i class='fa-regular fa-heart'></i>{$productModel->countLike($product['id'])}</button>
                                </form>
                            </div>";
    } else {
        $content .= "<button class='btn-like badge btn border border-2 border-danger text-danger'><i class='fa-regular fa-heart'></i> {$productModel->countLike($product['id'])}</button>";
    }

    $content .= "
                        </div>
                    </div>
                    <div class='content-card'>
                    <a class='title-item' href='detail.php?id={$product['id']}'>{$product['name']}</a><br />
                    </div>
                    <div class='text-item'>
                        <i>{$product['description']}</i><br />
                    </div>
                </a>
            </div>";
    echo $content;
}
