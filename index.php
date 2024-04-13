<?php

include ("connect.php");
require ("header.php");


$query = "SELECT * from Products INNER JOIN Category on Products.id_cat=Category.id_cat";
$product = mysqli_fetch_all(mysqli_query($con, $query));


?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css\style.css">
    <title>Document</title>
</head>

<body>
    <main>
        <section class="header-fizz">

            <div class="text-header">
                <img src="images\Group8197.png" class="back-img" alt="">
                <h1>ENJOY <br>
                    EVERY SIP</h1>
            </div>
            <div class="img-drink">
                <img src="images\Group 8179.png" alt="drink">

            </div>

        </section>


        <div class="swipe">
            <p class="text-descr">The ultimate refreshing drink <br>
                to enjoy in every festival</p>
            <img src="images\Group 8196.png" alt="" class="img-swipe">
        </div>
        <section class="catalog">
            <h2 id="menu-header">Меню</h2>

            <div class="container">
                <div class="categories">
                    <a href="#" class="category">Одежда</a>
                    <a href="#" class="category">Обувь</a>
                    <a href="#" class="category">Аксессуары</a>
                </div>
            </div>
            <div class="menu">
                <?php
                foreach ($product as $prod) {

                    echo "<div class='product'>";

                    $prod_id = $prod['0'];

                    echo "<img  src='images/" . $prod[5] . "' id='img'>";
                    echo "<a href='oneNew.php?new=$prod_id'>" . $prod[1] . "</a>";
                    echo "<p>Дата публикации " . $new['publish_date'] . "</p>";
                    echo "</div>";

                }

                ?>
            </div>
        </section>
    </main>

    <footer>
        <div class="links">
            <h3>Контакты</h3>
            <ul>
                <a href="#">
                    <li>Smth</li>
                </a>
                <a href="#">
                    <li>Smth</li>
                </a>
                <a href="#">
                    <li>Smth</li>
                </a>
                <a href="#">
                    <li>Smth</li>
                </a>
            </ul>
        </div>

        <div class="logo-cont">
            <img class="logo" src="images/logo.png" alt="Лого">
            <p>FIZZ (c) 2024 All rights reserved.</p>
        </div>
        <div class="links">
            <h3>Соц. сети</h3>
            <ul>
                <a href="#">
                    <li>Smth</li>
                </a>
                <a href="#">
                    <li>Smth</li>
                </a>
                <a href="#">
                    <li>Smth</li>
                </a>
                <a href="#">
                    <li>Smth</li>
                </a>
            </ul>
        </div>
    </footer>

</body>

</html>