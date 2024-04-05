<?php
session_start();
include "connect.php";
$email = strip_tags(trim($_POST['email']));
$pass = strip_tags(trim($_POST['password']));
$query = "SELECT * FROM `Users` WHERE email = '$email' and password = '$pass'";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);

if (count($user) == 0) {
    echo "Такой пользователь не найден";
    exit();
} else {
    $_SESSION["user_id"] = $user["user_id"];

    header('Location: acc.php');
}
?>