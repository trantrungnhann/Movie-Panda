<?php
class BillModel extends Model
{
    public function getBillsByUser($id)
    {
        $sql = parent::$connection->prepare('SELECT bill.created_at, user.name, product.name, seats, address, timePay, totalPrice FROM user INNER JOIN bill ON user.id = bill.user_id INNER JOIN product on product.id = bill.product_id where user.id = ? ORDER BY bill.created_at DESC');
        $sql->bind_param("s", $id);
        $items = [];
        $sql->execute();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }

    public function addBill($user_id, $product_id, $seats, $address, $timePay, $totalPrice)
    {
        $sql = parent::$connection->prepare("INSERT INTO `bill` (`id`, `user_id`, `product_id`, `seats`, `address`, `timePay`, `totalPrice`) VALUES (NULL, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param("ssssss", $user_id, $product_id, $seats, $address, $timePay, $totalPrice);
        if ($sql->execute()) {
            $response = [
                'message' => 'Bill added successfully',
                'status_code' => 200
            ];
        } else {
            $response = [
                'message' => 'Failed to add bill',
                'status_code' => 500
            ];
        }

        return json_encode($response);
    }
}
