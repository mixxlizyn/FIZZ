<?php
include ("connect.php");
require ("header.php");
$userEmail = isset($_SESSION["id"]) ? mysqli_fetch_assoc(mysqli_query($con, 'select email from Users where id=' . $_SESSION["id"]))["email"] : false;



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <p>Привет,
        <?= $userEmail ?>
    </p>
</body>

</html>