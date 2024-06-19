<?php
if (isset($_POST['edit'])) {
    // Если нажата кнопка "Изменить"
    $itemId = $_POST['id'];
    // Получение данных о товаре по $itemId из базы данных или массива
    $newName = $_POST['new_name'];
    $newPrice = $_POST['new_price'];
    $newDescription = $_POST['new_description'];

    // Код для обновления данных о товаре в базе данных или массиве
} elseif (isset($_POST['delete'])) {
    // Если нажата кнопка "Удалить"
    $itemId = $_POST['item_id'];
    // Удаление товара по $itemId из базы данных или массива

    // Перенаправление на страницу с обновленной таблицей
    header("Location: index.php");
    exit();
}
?>