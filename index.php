<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление заказами</title>
    <!-- Подключаем стили Bootstrap 5.0.0 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Управление заказами</h1>
        <div class="row">
            <div class="col-md-6">
            <form method="post" action="/src/create_order.php" class="card p-3">
                <div class="mb-3">
                    <label for="order_name" class="form-label">Название заказа:</label>
                    <input type="text" id="order_name" name="order_name" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Создать заказ</button>
            </form>
            </div>
            <div class="col-md-6">
                <h2>Список заказов</h2>
                <ul class="list-group">
                    <?php require __DIR__ .'/view_orders.php'; ?>
                </ul>
            </div>
        </div>
    </div>
    <!-- Подключаем скрипт Bootstrap для интерактивности -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
