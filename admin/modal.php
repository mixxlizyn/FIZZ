<?
session_start();
$userEmail = isset($_SESSION["id"]) ? mysqli_fetch_assoc(mysqli_query($con, 'select email from Users where id=' .
    $_SESSION["id"]))["email"] : false;

?>
<div id="menu">
    <a href="#" class="close-btn" onclick="closeMenu()">X</a>
    <a href="statistics.php">Статистика и отчеты</a>
    <a href="addProd.php">Товары</a>
    <a href="admin.php">Заказы</a>
    <a href="addCat.php">Категории</a>
    <a href="../exit.php">Выход</a>


</div>
<script>
    function openMenu() {
        document.getElementById("menu").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
    }

    function closeMenu() {
        document.getElementById("menu").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
    }
</script>