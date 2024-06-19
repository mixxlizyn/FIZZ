<?php
session_start();
include "connect.php";
require "header.php";

if (!isset($_SESSION["id"])) {
    echo "Вы должны войти в систему, чтобы увидеть свою историю заказов.";
    exit();
}

$user_id = $_SESSION["id"];

// Получаем информацию о пользователе
$query_user = "SELECT email, bonus FROM Users WHERE id = $user_id";
$user_result = mysqli_query($con, $query_user);
$user = mysqli_fetch_assoc($user_result);

// Получаем историю заказов пользователя
$query_orders = "SELECT * FROM Orders WHERE id_user = $user_id ORDER BY date_order DESC";
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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>История заказов</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <p>Привет,
        <?= htmlspecialchars($user['email']) ?>
    </p>
    <p>Ваши бонусы:
        <?= htmlspecialchars($user['bonus']) ?>
    </p>

    <h2>История заказов</h2>
    <?php if (count($orders) > 0): ?>
        <?php foreach ($orders as $order): ?>
            <div class="order">
                <h3>Заказ #
                    <?= htmlspecialchars($order['id']) ?> от
                    <?= htmlspecialchars($order['date_order']) ?>
                </h3>
                <p>Статус:
                    <?= htmlspecialchars($order['status']) ?>
                </p>
                <p>Итоговая стоимость:
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
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>У вас еще нет заказов.</p>
    <?php endif; ?>
</body>

</html>