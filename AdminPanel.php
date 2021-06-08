<?php
session_start();
require_once 'components\header.php';
require_once 'components\footer.php';
require_once 'classes\Admin.php';
?>
<html>
<h2 style="font-size: 24px; margin-left: 40%">Пошук користувача</h2>
<form method="post">
    <input class="form-control mr-sm-2" type="search" name="SearchBookForm"  placeholder="Введіть Username користувача"
           aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" name="Submit" type="submit=">Search</button>
</form>
</html>
<?php
echo '<br>';
$admin->findUser("Select * from User");

?>
