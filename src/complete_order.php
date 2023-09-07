<?php

require_once __DIR__ . '/Order.php';
require_once __DIR__ . '/Db.php';

$order_id = $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] != 'GET' && empty($order_id)) {
    die('Неверный запрос');
}

// Получаем информацию о заказе
$orders = $conn->query("SELECT * FROM `orders` WHERE `id` =" . $order_id);

if ($orders->num_rows == 1)
{
    
    $row = $orders->fetch_assoc();

    $order = new Order($row['name']);
    $createdDate = new DateTime($row['createdAt']);
    $updatedDate = new DateTime($row['updatedAt']);
    $status = $row["status"];
    
    $order->setCreatedAt($createdDate);
    $order->setUpdatedAt($updatedDate);
    $order->setStatus($status);

    $now = new DateTime();
    $createdDate = $order->getCreatedAt();
    $interval = $now->diff($createdDate);

    if ($order->getStatus() === 'confirmed')
    {
        // Завершаем заказ
        $order->complete();

        // Обновляем статус заказа в базе данных
        $sql = "UPDATE `orders` SET `status` = 'completed' WHERE `id` = $order_id";
        if ($conn->query($sql) === TRUE) {
            header('Location: /'); // Перенаправляем на основную страницу
        } else {
            echo 'Ошибка при завершении заказа: ' . $conn->error;
        }

    }

} else {
    echo 'Заказ не найден.';
}

$conn->close();
?>