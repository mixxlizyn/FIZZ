<?php
include ("connect.php");
require ("header.php");


$new = isset($_GET['new']) ? $_GET['new'] : false;
if ($new) {
    $query = "SELECT * FROM Products INNER JOIN Category ON Products.id_cat=Category.id_cat WHERE id=$new";
    $result = mysqli_query($con, $query);
    $product = mysqli_fetch_assoc($result);



    // if ($email) {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment'])) {
    //         $comment = mysqli_real_escape_string($con, $_POST['comment']);
    //         $product_id = $new;

    //         $id_user = $_SESSION["id"];
    //         $query = "INSERT INTO `comments`( `id_prod`, `user_id`, `comment_text`) VALUES ('$new','$id_user', '$comment')";
    //         mysqli_query($con, $query);
    //     }


    // }

    // Handle form submission

    // // Fetch comments
    // $query_comments = "SELECT * FROM comments WHERE id_prod='$new' ORDER BY comment_date DESC";
    // $comments = mysqli_fetch_all(mysqli_query($con, $query_comments), MYSQLI_ASSOC);
}
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
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>
        <?php echo $product['product_name']; ?>
    </title>
    <style>
        .comment-form textarea {
            width: 1000px;
        }



        body {
            background-color: #3a5145;


        }

        .product-detail-card {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            text-align: center;
        }

        .product-detail-image {
            width: 100%;
            max-width: 400px;
            border-radius: 10px;
        }

        .product-detail-name {
            margin-top: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        .product-detail-price {
            margin-top: 10px;
            font-size: 20px;
            color: #28a745;
            font-weight: bold;
        }

        .product-detail-category {
            margin-top: 10px;
            font-size: 18px;
            color: #666;
        }

        .product-detail-description {
            margin-top: 15px;
            font-size: 16px;
            color: #333;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            font-size: 16px;
            color: #007BFF;
            text-decoration: none;
            border: 1px solid #007BFF;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .back-link:hover {
            background-color: #007BFF;
            color: #fff;
        }

        .add-to-cart-button {
            margin-top: 20px;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            background-color: #007BFF;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .add-to-cart-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="product-detail-card">
        <img src="images/<?php echo $product['image']; ?>" class="product-detail-image"
            alt="<?php echo $product['name']; ?>">
        <h1 class="product-detail-name">
            <?php echo $product['name']; ?>
        </h1>
        <p class="product-detail-price">
            <?php echo $product['price']; ?> руб.
        </p>
        <p class="product-detail-category">Категория:
            <?php echo $product['cat_name']; ?>
        </p>
        <p class="product-detail-description">
            <?php echo $product['descr']; ?>
        </p>
        <form id="add-to-cart-form" method="POST" action="add_to_cart.php">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <input type="number" name="quantity" value="1" min="1" required>
            <button type="submit" class="add-to-cart-button">Добавить в корзину</button>
        </form>


        <a href="catalog.php" class="back-link">Back to Menu</a>
    </div>
    <!-- Comment Form -->
    <?php if ($email) { ?>
        <div class="comment-form">
            <h3>Оставьте отзыв</h3>
            <form method="POST">
                <textarea name="comment" placeholder="Write your comment here..." required></textarea>
                <button type="submit">отправить</button>
            </form>
        </div>
        <?php
    } else
        echo "Войдите в аккаунт, чтобы написать отзыв";
    ?>

    <div class="comments">
        <h3>отзывы</h3>
        <?php
        // if ($comments) {
        //     foreach ($comments as $comment) {
        //         echo "<div class='comment'>";
        //         echo "<p>" . $comment['comment_text'] . "</p>";
        //         echo "<time>" . $comment['comment_date'] . "</time>";
        //         echo "</div>";
        //     }
        // } else {
        //     echo "<p>Нет отзывов.</p>";
        // }
        ?>
    </div>

    <!-- Display Comments -->


</body>

</html>