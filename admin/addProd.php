<?
include "../connect.php";
include "modal.php";

$query = "SELECT * from  Category ";
$categories = mysqli_fetch_all(mysqli_query($con, $query));

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Document</title>
</head>

<body>

    <div id="main">

        <button onclick="openMenu()"><img src="../images\icons8-меню-50.png" alt=""></button>


    </div>
    <div class="products">


    </div>
    <form action="addProddb.php" method="POST" enctype="multipart/form-data">
        <label for="title">Имя:</label>
        <input type="text" id="title" name="title" required />

        <label for="price">Цена:</label>
        <input type="text" id="price" name="price" required />

        <label for="description">Описание:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="category">Выберите категорию:</label>
        <select id="userCategory" name="category" selected='<?= $id_new ? $new_info["name"] : "" ?>'>
            <?php
            foreach ($categories as $category) {
                $id_cat = $category[0];
                $name = $category[1];
                echo "<option value='$id_cat'" . $id_new . ">$name</option>";
            }
            ?>
        </select>

        <label for="image">Фото:</label>
        <input type="file" id="image" name="image" required accept="images/*" />


        <input type="submit" value="Добавить товар" />
        </div>
    </form>

</body>

</html>