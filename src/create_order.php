<?php

require_once __DIR__ . '/Order.php';
require_once __DIR__ . '/Db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $order_name = $_POST["order_name"];

    // Проверяем, что поле имени заказа не пустое
    if (empty($order_name)) {
        echo 'Имя заказа не может быть пустым.';
        exit;
    }

    // Создаем новый заказ
    try {
        $order = new Order($order_name);
        $order->confirm();
    } catch (Exception $e) {
        echo 'Ошибка при создании заказа: ' . $e->getMessage();
        exit;
    }

    // SQL-запрос для добавления заказа в базу данных
    $sql = "INSERT INTO `orders` (`name`, `createdAt`, `updatedAt`, `status`)
            VALUES ('" . $order->getName() . "', '" . $order->getCreatedAt()->format('Y-m-d H:i:s') . "', '" . $order->getUpdatedAt()->format('Y-m-d H:i:s') . "', '" . $order->getStatus() . "')";

    if ($conn->query($sql) === TRUE) {
        header("Location: /"); // Перенаправляем на основную страницу
    } else {
        echo "Ошибка при добавлении заказа в базу данных: " . $conn->error;
    }

    $conn->close();
}
?>