<?php
session_start();
include "connect.php";

if (!isset($_SESSION["id"])) {
    echo "Вы должны войти в систему, чтобы добавить товар в корзину.";
    exit();
}

if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);
    $user_id = $_SESSION["id"];

    $query = "SELECT * FROM Basket WHERE id_user = $user_id";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $basket = mysqli_fetch_assoc($result);
        $basket_content = json_decode($basket['content'], true);
        if (isset($basket_content[$product_id])) {
            $basket_content[$product_id] += $quantity;
        } else {
            $basket_content[$product_id] = $quantity;
        }

        $new_content = json_encode($basket_content);
        $update_query = "UPDATE Basket SET content = '$new_content' WHERE id_user = $user_id";
        mysqli_query($con, $update_query);
    } else {
        $basket_content = [$product_id => $quantity];
        $content = json_encode($basket_content);
        $insert_query = "INSERT INTO Basket (id_user, content) VALUES ($user_id, '$content')";
        mysqli_query($con, $insert_query);
    }

    header("Location: oneNew.php?new=$product_id&added=1");
    exit();
} else {
    echo "Некорректные данные.";
}
?>