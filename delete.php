<?php
session_start();
require_once 'components\header.php';
require_once 'classes\Catalog.php';
require_once 'components\footer.php';
$data = $editAndDelete->findBookName($_GET['book_id']);
if (isset($_POST['Delete'])) {
    $editAndDelete->delete($_GET['book_id']);
    exit("<meta http-equiv='refresh' content='0; url=catalog.php'>");
}
if (isset($_POST['Cancel'])) {
    exit("<meta http-equiv='refresh' content='0; url=catalog.php'>");
}

?>
<html>
<h4>Підтвердити видалення <?php echo $data[0][0] ?>?</h4>
<form method="post">
    <p><input type="submit" name="Delete" value="Видалити">
        <input type="submit" name="Cancel" value="Відмінити"></p></form>

</html>
