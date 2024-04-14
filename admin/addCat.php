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

        <table>
            <tr>
                <th>Id</th>
                <th>Название</th>
            </tr>


            <?php
            foreach ($categories as $category) { ?>
                <tr>
                    <td>
                        <?= $category[0] ?>
                    </td>
                    <td>
                        <?= $category[1] ?>
                    </td>
                </tr>
            <?
            }
            ?>



        </table>
    </div>
    <form action="addCatdb.php" method="POST">
        <label for="name">Название</label>
        <input type="text" id="title" name="name" required />

        <input type="submit" value="Добавить товар" />
        </div>
    </form>

</body>

</html>