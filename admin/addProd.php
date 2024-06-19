<?
include "../connect.php";
include "modal.php";

$query = "SELECT * from  Category ";
$categories = mysqli_fetch_all(mysqli_query($con, $query));
$query_prod = "SELECT * FROM `Products` INNER JOIN Category on Products.id_cat=Category.id_cat";
$products = mysqli_query($con, $query_prod);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        #menu {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #333;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        #menu a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        #menu a:hover {
            color: #f1f1f1;
        }

        #menu .close-btn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 25px;
            margin-left: 50px;
        }

        #main {
            transition: margin-left 0.5s;
            padding: 16px;
        }

        button {

            background: none;
            border: none;
        }

        .product-form {
            margin: 20px;
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-header {
            background-color: #f1f1f1;
            color: #333;
        }

        .table-row:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table-row:nth-child(odd) {
            background-color: #fff;
        }

        .product-name,
        .product-price,
        .product-descr,
        .product-category,
        .product-image {
            padding: 10px;
            text-align: center;
        }

        .product-image img {
            max-width: 100px;
        }

        .action-form {
            display: inline;
        }

        .edit-btn,
        .delete-btn {
            background-color: #4CAF50;
            color: white;
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            text-transform: uppercase;
            font-weight: bold;
            margin: 5px;
        }

        .edit-btn:hover,
        .delete-btn:hover {
            background-color: #45a049;
        }

        .edit-btn:active,
        .delete-btn:active {
            background-color: #398f3f;
        }

        .add-form {
            margin: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            width: 300px;
        }

        .form-label {
            display: block;
            margin-top: 10px;
        }

        .form-input,
        .form-textarea,
        .form-select,
        .form-file-input {
            width: 100%;
            padding: 5px;
            margin-top: 5px;
            margin-bottom: 10px;
        }

        .submit-button {
            background-color: #007bff;
            color: white;
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            text-transform: uppercase;
        }

        .submit-button:hover {
            background-color: #0056b3;
        }

        .submit-button:active {
            background-color: #004b9e;
        }
    </style>
    <title>Document</title>
</head>

<body>

    <div id="main">

        <button onclick="openMenu()"><img src="../images\icons8-меню-50.png" alt=""></button>


        <div class="products">
            <form action="edit_delete_prod.php" class="product-form" enctype="multipart/form-data">
                <table border="1" class="product-table">
                    <tr class="table-header">
                        <th>Название товара</th>
                        <th>Цена</th>
                        <th>Описание</th>
                        <th>Категория</th>
                        <th>Фото</th>
                        <th>Действия</th>
                    </tr>
                    <?php
                    while ($row = $products->fetch_assoc()) { ?>
                        <tr class='table-row'>
                            <td class='product-name'><input type="text" name="name" value="<?= $row["name"] ?>"></td>
                            <td class='product-price'><input type="text" name="price" value="<?= $row["price"] ?>"></td>
                            <td class='product-descr'><input type="text" name="descr" value="<?= $row["descr"] ?>"></td>
                            <td class='product-category'><input type="text" name="cat_name" value="<?= $row["cat_name"] ?>">
                            </td>
                            <td class='product-image'><input type="file" name="image" value="<?= $row["image"] ?>"></td>
                            <td>
                                <form method="post" action="edit_delete_prod.php" class="action-form">
                                    <input type="hidden" name="item_id" value="<?= $row["id"] ?>">
                                    <input type="submit" name="edit" value="Изменить" class="edit-btn">
                                    <input type="submit" name="delete" value="Удалить" class="delete-btn">
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </form>
        </div>

        <form action="addProddb.php" method="POST" enctype="multipart/form-data" class="add-form">
            <label for="title" class="form-label">Название:</label>
            <input type="text" id="title" name="title" required class="form-input" />

            <label for="price" class="form-label">Цена:</label>
            <input type="text" id="price" name="price" required class="form-input" />

            <label for="description" class="form-label">Описание:</label>
            <textarea id="description" name="description" required class="form-textarea"></textarea>

            <label for="category" class="form-label">Выберите категорию:</label>
            <select id="userCategory" name="category" selected='<?= $id_new ? $new_info["name"] : "" ?>'
                class="form-select">
                <?php
                foreach ($categories as $category) {
                    $id_cat = $category[0];
                    $name = $category[1];
                    echo "<option value='$id_cat'" . $id_new . ">$name</option>";
                }
                ?>
            </select>

            <label for="image" class="form-label">Фото:</label>
            <input type="file" id="image" name="image" required accept="images/*" class="form-file-input" />

            <input type="submit" value="Добавить товар" class="submit-button" />
        </form>
</body>

</html>