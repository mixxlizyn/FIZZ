<?
session_start();
$email = isset($_SESSION["id"]) ? mysqli_fetch_assoc(mysqli_query($con, 'select email from users where id =' . $_SESSION["id"]))["email"] : false;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\style.css">
    <title>Document</title>
</head>

<body>
    <nav>
        <a href="">Корзина</a>
        <a href="#catalog">Каталог</a>
        <?php if ($email) { ?>
            <a href="acc.php">
                <?= $email ?>
            </a>
        <?php } ?>
        <!-- <a href="">личный кабинет</a> -->
        <a href="#"><img class="logo" src="images/logo.png" alt="Лого"></a>

        <?php
        if (!$email) { ?>
            <a href="registration.php">Регистрация</a>

        <?
        } ?>
        <a href='<?= (!$email) ? "authorization" : "exit" ?>.php'>
            <?= (!$email) ? "Вход" : "Выход" ?>
        </a>
    </nav>
</body>

</html>