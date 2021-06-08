<?php
session_start();
require('components/header.php');
require('components/footer.php');
require_once 'classes\User.php';

?>
<html>
<h2 style="margin-left: 45%;font-size: 24px">Формуляр</h2>

</html>
<?php
$userData = $user->getInfo();
$id = $userData[0][0];
$user->getRecordList($id);

?>