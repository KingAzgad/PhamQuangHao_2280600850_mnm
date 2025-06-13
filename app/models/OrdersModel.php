<?php

class ordersModel
{
    private $conn;
    private $table_name = "orders";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getOrders()
    {
        $query = "SELECT 
                o.id,
                o.name,
                o.phone,
                o.address,
                o.created_at,
                SUM(od.price * od.quantity) AS total_amount
              FROM orders o
              JOIN order_details od ON o.id = od.order_id
              GROUP BY o.id, o.name, o.phone, o.address, o.created_at
              ORDER BY o.created_at DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getOrderDetailsById($orderId)
    {
        // Lấy thông tin đơn hàng
        $orderQuery = "SELECT * FROM orders WHERE id = :id";
        $stmt = $this->conn->prepare($orderQuery);
        $stmt->bindParam(':id', $orderId, PDO::PARAM_INT);
        $stmt->execute();
        $order = $stmt->fetch(PDO::FETCH_OBJ);

        // Lấy chi tiết sản phẩm
        $detailQuery = "SELECT product_id, quantity, price FROM order_details WHERE order_id = :id";
        $stmt = $this->conn->prepare($detailQuery);
        $stmt->bindParam(':id', $orderId, PDO::PARAM_INT);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_OBJ);

        return ['order' => $order, 'products' => $products];
    }

    public function getOrdersByUserId($userId)
    {
        $query = "SELECT 
                o.id,
                o.name,
                o.phone,
                o.address,
                o.created_at,
                SUM(od.price * od.quantity) AS total_amount
              FROM orders o
              JOIN order_details od ON o.id = od.order_id
              WHERE o.user_id = :user_id
              GROUP BY o.id, o.phone, o.address, o.created_at
              ORDER BY o.created_at DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getOrderCount()
    {
        $query = "SELECT COUNT(*) FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function createOrder($data)
    {
        // Giả sử $data chứa thông tin đơn hàng
        $query = "INSERT INTO " . $this->table_name . " (name, phone, address, user_id) 
                  VALUES (:name, :phone, :address, :user_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':address', $data['address']);
        $stmt->bindParam(':user_id', $data['user_id']);
        return $stmt->execute();
    }
    public function updateOrder($id, $data)
    {
        $query = "UPDATE " . $this->table_name . " 
                  SET name = :name, phone = :phone, address = :address 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':address', $data['address']);
        return $stmt->execute();
    }
    public function deleteOrder($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

}
