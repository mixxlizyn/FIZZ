<?
session_start();
$email = isset($_SESSION["id"]) ? mysqli_fetch_assoc(mysqli_query($con, 'select email from users where id =' . $_SESSION["id"]))["email"] : false;


?>
<nav>
    <a href="#">меню</a>
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