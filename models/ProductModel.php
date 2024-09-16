<?php
class ProductModel extends Model
{
    public function getProducts($limit = null)
    {
        if (isset($limit)) {
            $sql = parent::$connection->prepare("SELECT * FROM product LIMIT $limit");
        } else {
            $sql = parent::$connection->prepare("SELECT * FROM product");
        }
        $items = [];
        $sql->execute();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    public function getRandomProducts($limit = null)
    {
        if (isset($limit)) {
            $sql = parent::$connection->prepare("SELECT * FROM product ORDER BY RAND() LIMIT {$limit}");
        } else {
            $sql = parent::$connection->prepare("SELECT * FROM product ORDER BY RAND()");
        }
        $items = [];
        $sql->execute();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }

    public function getProductByCategory($category, $limit = null)
    {
        if (isset($limit)) {
            $sql = parent::$connection->prepare("SELECT * FROM product WHERE category_id = ? ORDER BY id DESC LIMIT {$limit}");
        } else {
            $sql = parent::$connection->prepare("SELECT * FROM product WHERE category_id = ? ORDER BY id DESC");
        }
        $sql->bind_param("i", $category);
        $items = [];
        $sql->execute();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }

    public function deleteProduct($id)
    {
        $sql = parent::$connection->prepare("DELETE FROM product WHERE id = ?");
        $sql->bind_param("i", $id);
        return $sql->execute();
    }

    public function getProductByID($id)
    {
        $sql = parent::$connection->prepare("SELECT * FROM product WHERE id = ?");
        $sql->bind_param("s", $id);
        $items = [];
        $sql->execute();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items[0];
    }


    public function addProduct($name, $description, $price, $image, $category_id, $banner, $imdb, $timer, $trailer)
    {
        $sql = parent::$connection->prepare("INSERT INTO `product` (`id`, `name`, `description`, `price`, `image`, `category_id`, `banner`, `imdb`, `timer`, `trailer`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param("sssssssss", $name, $description, $price, $image, $category_id, $banner, $imdb, $timer, $trailer);
        return $sql->execute();
    }

    public function updateProduct($id, $name, $description, $price, $image, $category_id, $banner, $imdb, $timer, $trailer)
    {
        $sql = parent::$connection->prepare("UPDATE `product` SET `name` = ?, `description` = ?, `price` = ?, `image` = ?, `category_id` = ?, `banner` = ?, `imdb` = ?, `timer` = ?, `trailer` = ? WHERE `product`.`id` = ?");
        $sql->bind_param("ssssssssss", $name, $description, $price, $image, $category_id, $banner, $imdb, $timer, $trailer, $id);
        return $sql->execute();
    }
    public function findProductBykey($key)
    {
        $sql = parent::$connection->prepare("SELECT * FROM product WHERE name LIKE '%$key%'");
        $items = [];
        $sql->execute();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }

    public function countProductByKey($key)
    {
        $sql = parent::$connection->prepare("SELECT * FROM product WHERE name LIKE '%$key%'");
        $sql->execute();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return count($items);
    }

    public function getLimitProducts($page, $perPage)
    {
        $startPage = ($page - 1) * $perPage;
        $sql = parent::$connection->prepare("SELECT * FROM `product` LIMIT ?, ?");
        $sql->bind_param("ii", $startPage, $perPage);
        $sql->execute();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }

    public function linksLimitProduct($url, $total, $perPage, $page)
    {
        $link = "";
        $totallink = ceil($total / $perPage);
        if ($totallink != 1 && $totallink != 0) {
            $next = $page + 1;
            $revius = $page - 1;
            if ($page == 1) {
                $revius = 1;
            }
            if ($page == $totallink) {

                $next = $totallink;
            }
            $link = "<ul class='pagination justify-content-center mt-4'><li class='page-item'><a class='page-link' href=$url&page=1>first</a></li><li class='page-item'><a class='page-link' href=$url&page=$revius><</a></li>";
            for ($i = 1; $i <= $totallink; $i++) {
                if ($i == $page) {
                    $link =  $link . "<li class='page-item active'><a class='page-link bg-danger border-danger' href=$url&page=$i>$i</a></li>";
                } else {
                    $link =  $link . "<li class='page-item'><a class='page-link' href=$url&page=$i>$i</a></li>";
                }
            }
            $link = $link . "<li class='page-item'><a class='page-link' href=$url&page=$next>></a></li><li class='page-item'><a class='page-link' href=$url&page=$totallink>last</a></li></nav>";
        }

        return $link;
    }
    public function updateProductView($id)
    {
        $sql = parent::$connection->prepare('UPDATE `product` SET `product_view` = `product_view` + 1 WHERE `id`=?');
        $sql->bind_param('i', $id);
        return $sql->execute();
    }

    //UPDATE
    public function updateProductLike($id)
    {
        $sql = parent::$connection->prepare('UPDATE `product` SET `product_like` = `product_like` + 1 WHERE `id`=?');
        $sql->bind_param('i', $id);
        return $sql->execute();
    }
    public function countLike($productId)
    {
        $items = [];
        $sql = parent::$connection->prepare("SELECT COUNT(*) FROM product_like where product_id = ?");
        $sql->bind_param('i', $productId);
        $sql->execute();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items[0]['COUNT(*)'];
    }
    public function checkLike($productId, $userId)
    {
        $items = [];
        $sql = parent::$connection->prepare("SELECT * FROM product_like where product_id = ? and user_id = ?");
        $sql->bind_param('ii', $productId, $userId);
        $sql->execute();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        if (count($items) >= 1) {
            return true;
        } else {
            return false;
        }
    }
    public function addLike($productId, $userId)
    {

        $sql = parent::$connection->prepare("INSERT INTO `product_like` (`product_id`, `user_id`) VALUES (?, ?)");
        $sql->bind_param('ii', $productId, $userId);
        return $sql->execute();
    }
    public function removeLike($productId, $userId)
    {
        $sql = parent::$connection->prepare("DELETE FROM `product_like` WHERE user_id = ? AND product_id = ?");
        $sql->bind_param('ii', $userId, $productId);
        return $sql->execute();
    }
    public function getComment($productId)
    {
        $sql = parent::$connection->prepare("SELECT * FROM `product_comment` WHERE product_id = ?");
        $sql->bind_param('s', $productId);
        $items = [];
        $sql->execute();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    public function addComment($productId, $userId, $content)
    {
        $sql = parent::$connection->prepare("INSERT INTO `product_comment` (`product_id`, `user_id`, `content`) VALUES (?, ?, ?)");
        $sql->bind_param('sss', $productId, $userId, $content);
        return $sql->execute();
    }
}
