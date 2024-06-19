<?php
include "connect.php";

session_start();
$newUserId = mysqli_insert_id($con);

$email = strip_tags(trim($_POST['email']));
$pass = strip_tags(trim($_POST['password']));

$_SESSION['user_id'] = $newUserId;
if (!empty($user1)) {
    echo "Данный логин уже используется!";
    exit();
}
$result2 = mysqli_query($con, "SELECT * FROM `Users` WHERE `email` = '$email'");
$user1 = mysqli_fetch_assoc($result2); // Конвертируем в массив
if (!empty($user1)) {
    echo "Данная почта уже используется!";
    exit();
}
mysqli_query($con, "INSERT INTO `users` ( `password`, `email`)VALUES('$pass', '$email')");
header('Location: index.php');
?>