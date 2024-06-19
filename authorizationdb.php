<?php
session_start();
include "connect.php";

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = strip_tags(trim($_POST['email']));
    $pass = strip_tags(trim($_POST['password']));

    // Используйте подготовленные операторы для предотвращения SQL-инъекций
    $stmt = $con->prepare("SELECT * FROM `Users` WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $pass);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user === null) {
        echo "Такой пользователь не найден";
        exit();
    } else {
        $_SESSION["id"] = $user["id"];
        $_SESSION["role"] = $user["role"];
        if ($_SESSION["role"] == "admin") {
            header("Location: /admin/admin.php");
        } else {
            header('Location: acc.php');
        }
        exit();
    }
} else {
    echo "Некорректные данные.";
}
?>