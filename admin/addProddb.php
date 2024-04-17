<?php
include "../connect.php";

$Title = isset($_POST["title"]) ? $_POST["title"] : false;
$Price = isset($_POST["price"]) ? $_POST["price"] : false;
$Descr = isset($_POST["description"]) ? $_POST["description"] : false;
$Category = isset($_POST["category"]) ? $_POST["category"] : false;
$Images = isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"] : false;



if ($Price && $Title && $Descr && $Category) {

    $file_name = $Images["name"];
    move_uploaded_file($Images["tmp_name"], "../images/$file_name");


    $result = mysqli_query($con, "INSERT INTO `Products`(`name`, `descr`, `id_cat`, `price`, `image`) VALUES ('$Title','$Descr','$Category','$Price','$file_name')");
    if ($result) {
        echo "<script>alert('Товар добавлен'); location.href='addProd.php'</script>";
    } else {
        echo "Произошла ошибка: " . mysqli_error($con);
    }
} else {
    echo "Пожалуйста, заполните все поля.";
}




// function check($error)
// {
//     return "<script>alert('$error'); location.href ='/admin';</script>";
// }

// if ($Title and $Price and $Images and $Category and $Descr) {
//     if (strlen($Title) > 50)
//         echo check("Название не должно быть таким длинным!");
//     else {
//         $file_name = $Images["name"];
//         $result = mysqli_query($con, "INSERT INTO `Products`(`name`, `descr`, `id_cat`, `price`, `image`) VALUES ('$Title','$Descr','$Category','$Price','$file_name')");
//         if ($result) {
//             move_uploaded_file($Images["tmp_name"], "images/news/$file_name");
//             echo check("Товар добавлен");
//         } else
//             echo check("Произошла ошибка:" . mysqli_error($con));
//     }
// }



