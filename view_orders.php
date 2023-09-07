<?php

require_once __DIR__ . '/src/Order.php';
require_once __DIR__ . '/src/Db.php';

// SQL-запрос для выбора всех заказов
$result = $conn->query("SELECT * FROM `orders`");

if ($result->num_rows > 0)
{
    // Вывод данных о каждом заказе
    while ($row = $result->fetch_assoc())
    {
        $orderStatusClass = 'status-' . strtolower(str_replace(' ', '_', $row["status"])); // Генерируем класс для статуса

        echo '<li class="list-group-item ' . $orderStatusClass . '">';
        echo "ID: " . $row["id"] . "<br>";
        echo "Название: " . $row["name"] . "<br>";
        echo "Дата создания: " . $row["createdAt"] . "<br>";
        echo "Дата последнего изменения: " . $row["updatedAt"] . "<br>";
        echo "Статус: " . $row["status"] . "<br>";

        $createdAt = new DateTime($row["createdAt"]);
        $now = new DateTime();
        $interval = $now->diff($createdAt);

        switch($row['status'])
        {
            case 'created':
            case 'pending_confirmation':

                if ($interval->i >= 1) {
                    echo '<a href="/src/confirm_order.php?id=' . $row["id"] . '">Подтвердить</a>';
                } else {
                    echo 'Заказ можно подтвердить только после 1 минуты с момента создания.';
                }

                break;

            case 'confirmed':

                if ($interval->i >= 1) {
                    echo '<a href="/src/complete_order.php?id=' . $row["id"] . '">Завершить</a>';
                } else {
                    echo 'Заказ можно завершить только после 1 минуты с момента создания.';
                }

                break;

            default: echo ''; break;
        }
        
        echo '</li>';
    }

} else {
    echo 'Нет заказов.';
}

$conn->close();
?>
