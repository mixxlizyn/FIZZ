<?
include "../connect.php";
include "modal.php";

$query = "SELECT * from  Category ";
$categories = mysqli_fetch_all(mysqli_query($con, $query));
$id_cat = isset($_GET['cat']);
var_dump($id_cat);


// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
//     $id = $_POST['id'];
//     $name = $_POST['name'];

//     $update_query = "UPDATE Category SET name = '$name' WHERE id = $id";
//     mysqli_query($con, $update_query);
// }

// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
//     $id = $_POST['id'];

//     $delete_query = "DELETE FROM Category WHERE id = $id";
//     mysqli_query($con, $delete_query);
// }
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




    <!-- Форма для удаления категории -->

    <div class="products">
        <form action="delete-edit.php" method="post">
            <table>
                <tr>
                    <th>Id</th>
                    <th>Название</th>
                    <th>сохранить</th>
                    <th>удалить</th>

                </tr>


                <?php
                foreach ($categories as $cat) { ?>
                    <tr>

                        <td><input type="text" name="id" value="<?= $cat[0] ?>">

                        </td>
                        <td>
                            <input type="text" name="name" value="<?= $cat[1] ?>">

                        </td>
                        <td><input type="submit" name="edit" value="Изменить"></td>
            </form>


            <td>
                <form action="delete-edit.php" method="post">
                    <input type="hidden" name="id" value="<?= $cat[0] ?>">
                    <input type="submit" name="delete" value="Удалить категорию">
                </form>
            </td>
            </trs>
        <?
                }
                ?>


        </table>

    </div>



    <form action="addCatdb.php" method="POST">
        <label for="name">Название</label>
        <input type="text" id="title" name="name" required />

        <input type="submit" value="Добавить" />
        </div>
    </form>

</body>

</html>