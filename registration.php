<?php
include "connect.php";
include "header.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\aut_reg.css">

    <title>Document</title>
</head>

<body>
    <div class="container">
        <h1>Страница регистрации</h1>
        <form method="post" action="registrationdb.php">
            <label for="username">Электронная почта:</label><br>
            <input type="text" id="email" name="email"><br><br>
            <label for="password">Пароль:</label><br>
            <input type="password" id="password" name="password"><br><br>
            <input type="submit" value="Зарегистрироваться">
        </form>
    </div>
</body>

</html>