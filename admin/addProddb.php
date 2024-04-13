<?php
include "../connect.php";

$Title = isset($_POST["title"]) ? $_POST["title"] : false;
$Price = isset($_POST["price"]) ? $_POST["price"] : false;
$Descr = isset($_POST["description"]) ? $_POST["description"] : false;
$Category = isset($_POST["category"]) ? $_POST["category"] : false;
$Images = isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"] : false;

function check($error)
{
    return "<script>alert('$error'); location.href ='/admin';</script>";
}

if ($Title and $Price and $Images and $Category and $Descr) {
    if (strlen($userTitle) > 50)
        echo check("Название не должно быть таким длинным!");
    else {
        $file_name = $Images["name"];
        $result = mysqli_query($con, "INSERT INTO `News`( `image`, `title`, `content`, `category_id`) VALUES ( '$file_name','$userTitle', '$userContent', '$Category' )");
        if ($result) {
            move_uploaded_file($Images["tmp_name"], "images/news/$file_name");
            echo check("Новость успешна создана");
        } else
            echo check("Произошла ошибка:" . mysqli_error($con));
    }
} else {
    echo check("Все поля должны быть заполнены!");
}



