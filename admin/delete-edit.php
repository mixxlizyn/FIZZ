<?
include "../connect.php";
// $id_cat = isset($_POST['cat']);


$cat_id = $_POST['id'];
$delete = isset($_POST["delete"]) ? $_POST["delete"] : false;
$name = isset($_POST["name"]) ? $_POST["name"] : false;
$edit = isset($_POST["edit"]) ? $_POST["edit"] : false;

if ($delete) {
    $query = mysqli_query($con, "DELETE FROM `Category` WHERE  id_cat = $cat_id");
    if ($query) {
        echo "<script>alert(\"Категория успешно удалена\"); location.href='addCat.php'</script>";
    } else {
        echo "<script>alert(\"Ошибка при удалении категории\"); location.href='addCat.php'</script>";
    }
}

if ($edit) {
    $query = mysqli_query($con, "UPDATE `Category` SET `cat_name`='$name' WHERE id_cat = $cat_id");
    if ($query) {
        echo "<script>alert(\"Категория успешно обновлена\"); location.href='addCat.php'</script>";
    } else {
        echo "<script>alert(\"Ошибка при обновлении категории\"); location.href='addCat.php'</script>";
    }
}
