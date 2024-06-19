<?php
session_start();
include "../connect.php";
include "modal.php";

// Настройки пагинации
$items_per_page = 10; // Количество товаров на странице
$current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($current_page - 1) * $items_per_page;

// Получаем общее количество заказов
$query_total_orders = "SELECT COUNT(*) as total FROM Orders";
$total_orders_result = mysqli_query($con, $query_total_orders);
$total_orders_row = mysqli_fetch_assoc($total_orders_result);
$total_orders = $total_orders_row['total'];

// Получаем информацию о пользователе
$query_user = "SELECT * FROM Users";
$user_result = mysqli_query($con, $query_user);
$user = mysqli_fetch_assoc($user_result);

// Получаем историю заказов пользователя с учетом пагинации
$query_orders = "SELECT * FROM Orders ORDER BY date_order DESC LIMIT $items_per_page OFFSET $offset";
$orders_result = mysqli_query($con, $query_orders);
$orders = mysqli_fetch_all($orders_result, MYSQLI_ASSOC);

// Получаем детали заказов
$order_details = [];
foreach ($orders as $order) {
    $order_id = $order['id'];
    $query_order_details = "SELECT op.quanity, p.name, p.price FROM order_prod op JOIN Products p ON op.id_prod = p.id WHERE op.id_orders = $order_id";
    $order_details_result = mysqli_query($con, $query_order_details);
    $order_details[$order_id] = mysqli_fetch_all($order_details_result, MYSQLI_ASSOC);
}

// Рассчитываем общее количество страниц
$total_pages = ceil($total_orders / $items_per_page);

// Обработка изменения статуса заказа
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_status'])) {
    $order_id = (int) $_POST['order_id'];
    $new_status = mysqli_real_escape_string($con, $_POST['status']);

    // Получаем текущую историю статусов
    $query = "SELECT status_history FROM Orders WHERE id = $order_id";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $status_history = json_decode($row['status_history'], true) ?? [];

    // Добавляем новый статус в историю
    $status_history[] = ['status' => $new_status, 'changed_at' => date('Y-m-d H:i:s')];
    $status_history_json = mysqli_real_escape_string($con, json_encode($status_history));

    // Обновляем статус и историю в базе данных
    $query = "UPDATE Orders SET status = '$new_status', status_history = '$status_history_json' WHERE id = $order_id";
    mysqli_query($con, $query);

    header("Location: admin.php");
    exit();
}

// Обработка удаления заказа
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_order'])) {
    $order_id = (int) $_POST['order_id'];

    // Удаляем записи из связанных таблиц
    $query = "DELETE FROM order_prod WHERE id_orders = $order_id";
    mysqli_query($con, $query);

    // Удаляем сам заказ
    $query = "DELETE FROM Orders WHERE id = $order_id";
    mysqli_query($con, $query);

    header("Location: admin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <title>admin</title>
</head>

<body>

    <div id="main">
        <button onclick="openMenu()"><img src="../images/icons8-меню-50.png" alt=""></button>
    </div>

    <h2>История заказов</h2>
    <?php if (count($orders) > 0): ?>
        <?php foreach ($orders as $order): ?>
            <div class="order">
                <h3>Заказ #
                    <?= htmlspecialchars($order['id']) ?> от
                    <?= htmlspecialchars($order['date_order']) ?>
                </h3>
                <p>пользователь
                    <?= htmlspecialchars($user['email']) ?>
                </p>
                <p>Статус:
                    <?= htmlspecialchars($order['status']) ?>
                </p>
                <p>Итоговая прибыль:
                    <?= htmlspecialchars($order['Total_cost']) ?> руб.
                </p>
                <p>Использовано бонусов:
                    <?= htmlspecialchars($order['Used_bonus']) ?>
                </p>
                <p>Начислено бонусов:
                    <?= htmlspecialchars($order['Acc_bonus']) ?>
                </p>
                <h4>Товары:</h4>
                <ul>
                    <?php foreach ($order_details[$order['id']] as $detail): ?>
                        <li>
                            <?= htmlspecialchars($detail['name']) ?> -
                            <?= htmlspecialchars($detail['quanity']) ?> шт. -
                            <?= htmlspecialchars($detail['price']) ?> руб./шт.
                        </li>
                    <?php endforeach; ?>
                </ul>

                <h4>История изменений статусов:</h4>
                <?php
                $status_history = json_decode($order['status_history'], true) ?? [];
                if (count($status_history) > 0): ?>
                    <ul>
                        <?php foreach ($status_history as $status_change): ?>
                            <li>
                                Статус:
                                <?= htmlspecialchars($status_change['status']) ?> - Дата изменения:
                                <?= htmlspecialchars($status_change['changed_at']) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>Нет истории изменений статусов.</p>
                <?php endif; ?>

                <form method="post" action="">
                    <input type="hidden" name="order_id" value="<?= htmlspecialchars($order['id']) ?>">
                    <label for="status">Изменить статус:</label>
                    <select name="status">
                        <option value="Готовим">Готовим</option>
                        <option value="Доставка">Доставка</option>
                        <option value="Выполнено">Выполнено</option>
                    </select>
                    <button type="submit" name="change_status">Изменить</button>
                </form>
                <form method="post" action="">
                    <input type="hidden" name="order_id" value="<?= htmlspecialchars($order['id']) ?>">
                    <button type="submit" name="delete_order"
                        onclick="return confirm('Вы уверены, что хотите удалить этот заказ?');">Удалить заказ</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p> нет заказов.</p>
    <?php endif; ?>

    <!-- Пагинация -->
    <div class="pagination">
        <?php if ($current_page > 1): ?>
            <a href="?page=<?= $current_page - 1 ?>">&laquo; Предыдущая</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?= $i ?>" class="<?= $i == $current_page ? 'active' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <?php if ($current_page < $total_pages): ?>
            <a href="?page=<?= $current_page + 1 ?>">Следующая &raquo;</a>
        <?php endif; ?>
    </div>
</body>

</html>