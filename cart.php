<?php
session_start();
include "connect.php";
include "header.php";

if (!isset($_SESSION["id"])) {
    echo "Вы должны войти в систему, чтобы увидеть корзину.";
    exit();
}

$user_id = $_SESSION["id"];
$query = "SELECT * FROM Basket WHERE id_user = $user_id";
$result = mysqli_query($con, $query);
$basket = mysqli_fetch_assoc($result);

if ($basket) {
    $basket_content = json_decode($basket['content'], true);
    $product_ids = array_keys($basket_content);

    if (count($product_ids) > 0) {
        $ids_string = implode(',', $product_ids);
        $query_products = "SELECT * FROM Products WHERE id IN ($ids_string)";
        $products_result = mysqli_query($con, $query_products);
        $products = mysqli_fetch_all($products_result, MYSQLI_ASSOC);
    } else {
        $products = [];
    }
} else {
    $products = [];
}

$query_user = "SELECT * FROM Users WHERE id = $user_id";
$user_result = mysqli_query($con, $query_user);
$user = mysqli_fetch_assoc($user_result);

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Корзина</title>
    <style>
        body {
            background-color: #3a5145;

        }

        .cart-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
        }

        .cart-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }

        .cart-item img {
            max-width: 100px;
            border-radius: 5px;
        }

        .cart-item-details {
            flex-grow: 1;
            margin-left: 20px;
        }

        .cart-item-name {
            font-size: 18px;
            font-weight: bold;
        }

        .cart-item-quantity {
            font-size: 16px;
        }

        .cart-item-price {
            font-size: 18px;
            font-weight: bold;
            color: #28a745;
        }

        .checkout-button {
            display: block;
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 5px;
            background-color: #007BFF;
            color: #fff;
            font-size: 20px;
            text-align: center;
            cursor: pointer;
            margin-top: 20px;
            text-decoration: none;
        }

        .checkout-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="cart-container">
        <h1 class="cart-header">Ваша корзина</h1>
        <?php if (count($products) > 0) { ?>
            <?php
            $total_price = 0;
            foreach ($products as $product) {
                $quantity = $basket_content[$product['id']];
                $total_price += $product['price'] * $quantity;
                ?>
                <div class="cart-item">
                    <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                    <div class="cart-item-details">
                        <p class="cart-item-name">
                            <?php echo $product['name']; ?>
                        </p>
                        <p class="cart-item-quantity">Количество:
                            <?php echo $quantity; ?>
                        </p>
                    </div>
                    <p class="cart-item-price">
                        <?php echo $product['price'] * $quantity; ?> руб.
                    </p>
                </div>
            <?php } ?>
            <div class="cart-total">
                <h3>Итоговая сумма:
                    <?php echo $total_price; ?> руб.
                </h3>
            </div>
            <form action="checkout.php" method="POST">
                <label for="use_bonus">Использовать бонусы (доступно:
                    <?php echo $user['bonus']; ?>):
                </label>
                <input type="checkbox" id="use_bonus" name="use_bonus" value="yes">
                <button type="submit" class="checkout-button">Оформить заказ</button>
            </form>
        <?php } else { ?>
            <p>Ваша корзина пуста.</p>
        <?php } ?>
    </div>
</body>

</html>