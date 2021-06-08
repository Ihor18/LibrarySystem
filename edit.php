<?php
session_start();
require_once 'components\header.php';
require_once 'classes\Catalog.php';
require_once 'components\footer.php';
$data = $editAndDelete->getInfo($_GET['book_id']);
if (isset($_POST['Save'])) {
    $editAndDelete->edit($_POST['name'], $_POST['publishing'], $_POST['genre'], $_POST['pageNum'], $_POST['inStock'], $_GET['book_id']);
    exit("<meta http-equiv='refresh' content='0; url=catalog.php'>");
}
if (isset($_POST['Cancel'])) {
    exit("<meta http-equiv='refresh' content='0; url=catalog.php'>");
}
?>
<html>

<h1>Редагування книги: <?php echo $data[0][1] ?></h1>
<form method="post">
    <p>Назва:
        <input type="text" value="<?php echo $data[0][1] ?>" name="name" size="40"></p>
    <p>Видавництво:
        <input type="text" value="<?php echo $data[0][2] ?>" name="publishing" size="40"></p>
    <p>Жанр:
        <input type="text" value="<?php echo $data[0][3] ?>" name="genre" size="40"></p>
    <p>Кількість сторінок:
        <input type="text" value="<?php echo $data[0][4] ?>" name="pageNum" size="40"></p>
    <p>В наявності:
        <input type="text" value="<?php echo $data[0][5] ?>" name="inStock" size="40"></p>

    <p><input type="submit" name="Save" value="Зберегти">
        <input type="submit" name="Cancel" value="Відмінити">

</form>
</html>
