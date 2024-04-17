<?php
include "../connect.php";

$name = isset($_POST["name"]) ? $_POST["name"] : false;

$result = mysqli_query($con, "INSERT INTO `Category`( `name`) VALUES ('$name')");
if ($result) {
    echo "<script>alert('категория добавлена'); location.href='addCat.php'</script>";
} else {
    echo "Произошла ошибка: " . mysqli_error($con);
}



