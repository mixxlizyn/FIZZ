<?php
session_start();
include "../connect.php";
include "modal.php";

// Получение общей статистики
$query_total_revenue = "SELECT SUM(Total_cost) as total_revenue FROM Orders WHERE status = 'Выполнено'";
$result_total_revenue = mysqli_query($con, $query_total_revenue);
$total_revenue = mysqli_fetch_assoc($result_total_revenue)['total_revenue'];

$query_total_orders = "SELECT COUNT(*) as total_orders FROM Orders";
$result_total_orders = mysqli_query($con, $query_total_orders);
$total_orders = mysqli_fetch_assoc($result_total_orders)['total_orders'];

$query_total_products_sold = "
    SELECT SUM(op.quanity) as total_products_sold
    FROM order_prod op
    JOIN Orders o ON op.id_orders = o.id
    WHERE o.status = 'Выполнено'";
$result_total_products_sold = mysqli_query($con, $query_total_products_sold);
$total_products_sold = mysqli_fetch_assoc($result_total_products_sold)['total_products_sold'];

$query_top_products = "
    SELECT p.name, SUM(op.quanity) as total_sold
    FROM order_prod op
    JOIN Products p ON op.id_prod = p.id
    JOIN Orders o ON op.id_orders = o.id
    WHERE o.status = 'Выполнено'
    GROUP BY p.name
    ORDER BY total_sold DESC
    LIMIT 5";
$result_top_products = mysqli_query($con, $query_top_products);
$top_products = mysqli_fetch_all($result_top_products, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <title>Статистика продаж</title>
</head>

<body>

    <div id="main">
        <button onclick="openMenu()"><img src="../images/icons8-меню-50.png" alt=""></button>
    </div>

    <h2>Общая статистика по продажам и заказам</h2>

    <div class="statistics">
        <p>Суммарная выручка:
            <?= htmlspecialchars($total_revenue) ?> руб.
        </p>
        <p>Общее количество заказов:
            <?= htmlspecialchars($total_orders) ?>
        </p>
        <p>Общее количество проданных товаров:
            <?= htmlspecialchars($total_products_sold) ?>
        </p>
    </div>

    <h3>Топ 5 самых продаваемых товаров</h3>
    <table>
        <thead>
            <tr>
                <th>Название продукта</th>
                <th>Количество проданных товаров</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($top_products as $product): ?>
                <tr>
                    <td>
                        <?= htmlspecialchars($product['name']) ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($product['total_sold']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>