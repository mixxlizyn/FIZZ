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
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0 20px;
        background-color: #3a5145;

        color: #333;
    }

    .user-info {
        background-color: #fff;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .user-info p {
        margin: 0;
        padding: 5px 0;
    }

    h2 {
        color: #444;
    }

    .order {
        background-color: #fff;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .order h3 {
        margin-top: 0;
    }

    .order p {
        margin: 5px 0;
    }

    .order ul {
        list-style-type: none;
        padding: 0;
        margin: 10px 0 0 0;
    }

    .order ul li {
        background-color: #f9f9f9;
        padding: 10px;
        margin-bottom: 5px;
        border: 1px solid #ddd;
        border-radius: 3px;
    }

    .order ul li:last-child {
        margin-bottom: 0;
    }
</style>

<body>
    <div class="user-info">
        <p>Привет,
            <?= htmlspecialchars($user['email']) ?>
        </p>
        <p>Ваши бонусы:
            <?= htmlspecialchars($user['bonus']) ?>
        </p>
    </div>

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