<?php

include ("connect.php");
require ("header.php");

$query = "SELECT * from Products INNER JOIN Category on Products.id_cat=Category.id_cat";
$product = mysqli_fetch_all(mysqli_query($con, $query));
$query_cat = "SELECT * from  Category";
$categories = mysqli_fetch_all(mysqli_query($con, $query_cat));
$cat = isset($_GET['cat']) ? $_GET['cat'] : false;

if ($cat) {
    $query = "SELECT * FROM `Products` INNER JOIN Category on Products.id_cat=Category.id_cat WHERE Category.id_cat=$cat";
    $product = mysqli_fetch_all(mysqli_query($con, $query));
}

?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">

    <title>Главная</title>
    <style>
        body {
            background-color: #3a5145;

        }

        .product-card {
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 15px;
            text-align: center;
        }

        .product-image {
            width: 100%;
            max-width: 250px;
        }

        .product-name {
            margin-top: 10px;
            font-size: 18px;
        }

        .product-price {
            margin-top: 5px;
            font-size: 16px;
        }

        .product-category {
            margin-top: 5px;
            font-size: 16px;
        }

        .review-card {
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 15px;
            margin: 10px;
        }

        .review-content {
            font-size: 14px;
        }

        .review-author {
            margin-top: 10px;
            font-size: 16px;
            font-weight: bold;
        }

        .review-rating {
            color: gold;
        }

        .about-us,
        .contact-us {
            padding: 20px;
            margin: 20px 0;
            background-color: #f9f9f9;
            border-radius: 5px;
        }

        .about-us h2,
        .contact-us h2 {
            margin-bottom: 15px;
        }

        .about-us p,
        .contact-us p {
            font-size: 16px;
        }
    </style>
</head>

<body>
    <main>
        <section class="header-fizz">
            <div class="text-header">
                <img src="images\Group8197.png" class="back-img" alt="">
                <h1>ENJOY <br> EVERY SIP</h1>
            </div>
            <div class="img-drink">
                <img src="images\Group 8179.png" alt="drink">
            </div>
        </section>
        <div class="swipe">
            <p class="text-descr">The ultimate refreshing drink <br> to enjoy in every festival</p>
            <img src="images\Group 8196.png" alt="" class="img-swipe">
        </div>
        <!-- <section class="catalog" id="catalog">
            <h2 id="menu-header">Меню</h2>
            <div class="container">
                <div class="categories">
                    <?php
                    // foreach ($categories as $cat) {
                    //     echo "<li> <a href='index.php?cat=$cat[0]' class='category'>$cat[1]</a></li>";
                    // }
                    ?>
                </div>
            </div>
            <div class="menu">
                <?php
                // foreach ($product as $prod) {
                //     echo "<div class='product-card'>";
                //     $prod_id = $prod['0'];
                //     echo "<img  src='images/" . $prod[5] . "' class='product-image'>";
                //     echo "<a href='oneNew.php?new=$prod_id' class='product-name'>" . $prod[1] . "</a>";
                //     echo "<p class='product-price'>" . $prod[4] . "</p>";
                //     echo "<p class='product-category'>" . $prod[7] . "</p>";
                //     echo "</div>";
                // } 
                ?>
            </div>
        </section> -->
        <section class="about-us">
            <h2>About Us</h2>
            <p>Welcome to our site! We are passionate about providing you with the best beverages to refresh and
                rejuvenate your senses. Our selection is crafted with care, ensuring every sip is a delight. Join us on
                a journey of taste and quality.</p>
        </section>
        <section class="reviews">
            <h2>Customer Reviews</h2>
            <div class="review-card">
                <p class="review-content">"Absolutely love these drinks! Perfect for any occasion and always
                    refreshing."</p>
                <p class="review-author">- John Doe</p>
                <p class="review-rating">★★★★★</p>
            </div>
            <div class="review-card">
                <p class="review-content">"Great variety and amazing flavors. Highly recommend to anyone looking for
                    quality beverages."</p>
                <p class="review-author">- Jane Smith</p>
                <p class="review-rating">★★★★★</p>
            </div>
            <div class="review-card">
                <p class="review-content">"I am a regular customer and have never been disappointed. Top-notch service
                    and products."</p>
                <p class="review-author">- Alex Brown</p>
                <p class="review-rating">★★★★★</p>
            </div>
        </section>
        <section class="contact-us">
            <h2>Contact Us</h2>
            <p>If you have any questions or feedback, feel free to reach out to us. We are here to help and ensure you
                have the best experience with our products.</p>
            <p>Email: support@example.com</p>
            <p>Phone: +1 234 567 890</p>
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