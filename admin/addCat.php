<?
include "../connect.php";
include "modal.php";

$query = "SELECT * from  Category ";
$categories = mysqli_fetch_all(mysqli_query($con, $query));
// $categories = mysqli_query($con, $query);

$id_cat = isset($_GET['cat']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <style>
        .products {
            margin-top: 20px;
        }

        .products table {
            width: 100%;
            border-collapse: collapse;
        }

        .products th,
        .products td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ccc;
        }

        .products th {
            background-color: #f2f2f2;
        }

        .products input {
            padding: 5px;
            margin: 5px;
        }

        .products input {
            width: 150px;
        }

        .products .submit {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
        }

        .products .submit:hover {
            background-color: #45a049;
        }

        .products form {
            display: inline;
        }
    </style>
</head>

<body>
    <div id="main">
        <button onclick="openMenu()"><img src="../images\icons8-меню-50.png" alt=""></button>
    </div>
    <form action="addCatdb.php" method="POST">
        <label for="name">Название</label>
        <input type="text" id="title" name="name" required />

        <input type="submit" value="Добавить" />
        </div>
    </form>
    <div class="products">
        <form action="delete-edit.php" method="post">
            <table>
                <tr>
                    <!-- <th>Id</th> -->
                    <th>Название</th>
                    <th>сохранить</th>
                    <th>удалить</th>

                </tr>
                <?php
                foreach ($categories as $cat) { ?>
                    <tr>

                        <input type="hidden" name="id" value="<?= $cat[0] ?>">


                        <td>
                            <input type="text" name="name" value="<?= $cat[1] ?>">

                        </td>


                        <td><input type="submit" name="edit" value="Изменить"></td>
            </form>
            <td>
                <form action="delete-edit.php" method="post">
                    <input type="hidden" name="id" value="<?= $cat[0] ?>">
                    <input type="submit" class="submit" name="delete" value="Удалить категорию">
                </form>
            </td>
            </tr>
        <?
                }
                ?>


        </table>


    </div>
</body>

</html>



<?php
// while ($row = mysqli_fetch_assoc($categories)) {
?>
<!-- <form action="" method="post">
                    <input type="text" name="name" value="<?= $row["cat_name"] ?>">
                    <input type="hidden" name="id" value="<?= $row["id_cat"] ?>">
                    <input type="submit" name="edit" value="Редактировать">
                    <input type="submit" name="delete" value="Удалить">
                </form> -->
<?php
// }
?>