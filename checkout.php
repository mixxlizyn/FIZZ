<?php
session_start();
include "connect.php";
include "header.php";

if (!isset($_SESSION["id"])) {
    echo "Вы должны войти в систему, чтобы оформить заказ.";
    exit();
}

$user_id = $_SESSION["id"];

// Получаем информацию о корзине
$query = "SELECT * FROM Basket WHERE id_user = $user_id";
$result = mysqli_query($con, $query);
$basket = mysqli_fetch_assoc($result);

if (!$basket) {
    echo "Ваша корзина пуста.";
    exit();
}

$basket_content = json_decode($basket['content'], true);
$product_ids = array_keys($basket_content);

// Получаем информацию о пользователе (для использования бонусов)
$query_user = "SELECT * FROM Users WHERE id = $user_id";
$user_result = mysqli_query($con, $query_user);
$user = mysqli_fetch_assoc($user_result);

if (count($product_ids) > 0) {
    $ids_string = implode(',', $product_ids);
    $query_products = "SELECT * FROM Products WHERE id IN ($ids_string)";
    $products_result = mysqli_query($con, $query_products);
    $products = mysqli_fetch_all($products_result, MYSQLI_ASSOC);
} else {
    $products = [];
}

if (count($products) > 0) {
    $total_price = 0;
    foreach ($products as $product) {
        $quantity = $basket_content[$product['id']];
        $total_price += $product['price'] * $quantity;
    }

    // Использование бонусов
    $used_bonus = 0;
    if (isset($_POST['use_bonus']) && $_POST['use_bonus'] == 'yes') {
        $used_bonus = min($user['bonus'], $total_price);
        $total_price -= $used_bonus;
    }

    // Начисление новых бонусов (5% от итоговой суммы)
    $acc_bonus = $total_price * 0.05;

    // Вставка заказа в базу данных
    $query_order = "INSERT INTO Orders (id_user, `status`, Total_cost, Used_bonus, Acc_bonus) VALUES ($user_id, 'оформлен', $total_price, $used_bonus, $acc_bonus)";
    mysqli_query($con, $query_order);
    $order_id = mysqli_insert_id($con);

    // Вставка товаров заказа в базу данных
    foreach ($products as $product) {
        $product_id = $product['id'];
        $quantity = $basket_content[$product_id];
        $query_order_product = "INSERT INTO order_prod (id_prod, id_orders, quanity) VALUES ($product_id, $order_id, $quantity)";
        mysqli_query($con, $query_order_product);
    }

    // Очистка корзины
    $query_clear_basket = "DELETE FROM Basket WHERE id_user = $user_id";
    mysqli_query($con, $query_clear_basket);

    // Обновление бонусов пользователя
    $new_bonus = $user['bonus'] - $used_bonus + $acc_bonus;
    $query_update_bonus = "UPDATE Users SET bonus = $new_bonus WHERE id = $user_id";
    mysqli_query($con, $query_update_bonus);
    echo "<script>
    alert('Заказ успешно оформлен. Итого к оплате: $total_price руб. Использовано бонусов: $used_bonus. Начислено новых бонусов: $acc_bonus.');
    location.href = 'acc.php';
    </script>";


    "";
} else {
    echo "<script>
    alert('наташа, отмена');
    location.href = 'cart.php';
    </script>";

}