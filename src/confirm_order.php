<?php
require_once __DIR__ . '/Order.php';
require_once __DIR__ . '/Db.php';

$order_id = $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] != "GET" && empty($order_id)) {
    die("Неверный запрос");
}

// Получаем информацию о заказе
$sql = "SELECT * FROM `orders` WHERE `id` = $order_id";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $order = new Order($row["name"]);
    $order->confirm();

    // Обновляем статус заказа в базе данных
    $sql = "UPDATE `orders` SET `status` = 'confirmed' WHERE `id` = $order_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: /"); // Перенаправляем на основную страницу
    } else {
        echo "Ошибка при подтверждении заказа: " . $conn->error;
    }
} else {
    echo "Заказ не найден.";
}

$conn->close();
?>