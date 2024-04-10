<?
include "../connect.php";
include "modal.php";

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
    <form action="" method="get">
        <div class="form-group">
            <label for="name">Имя:</label>
            <input type="text" id="title" name="title" required />
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" id="price" name="price" required />
        </div>
        <div class="form-group">
            <label for="phone">Телефон:</label>
            <textarea id="description" name="description" required"></textarea>
        </div>
        <div class="form-group">
            <label for="message">Сообщение:</label>
            <input type="text" id="category" name="category" required></ш>
        </div>
        <div class="form-group">
            <label for="message">Сообщение:</label>
            <input type="file" id="image" name="image" required></ш>
        </div>
        <div class="form-group">
            <input type="submit" value="Добавить товар" />
        </div>
    </form>

</body>

</html>