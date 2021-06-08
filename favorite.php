<?php
session_start();
require_once 'components\header.php';
require_once 'components\footer.php';
require_once 'classes\User.php';
?>
<html>
<h2 style="font-size: 24px; margin-left: 40%">Список улюблених книг</h2>
</html>
<?php
$userData = $user->getInfo();
$id = $userData[0][0];
$user->getTypeList($id,'Like');
?>