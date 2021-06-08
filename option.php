<?php
session_start();
require_once 'components\header.php';
require_once 'classes\User.php';
require_once 'components\footer.php';
$data=$user->getInfo($_SESSION['Username']);
if(isset($_POST['Save'])) {
    $user->update($data[0][0],$_POST['firstName'],$_POST['lastName'],$_POST['email'],$_POST['phoneNum'],$_POST['userName']);
    exit("<meta http-equiv='refresh' content='0; url=account.php'>");
}
if(isset($_POST['Cancel'])){
    exit("<meta http-equiv='refresh' content='0; url=account.php'>");
}
if($data[0][7]==null){
    $data[0][7]='Не додано';
}
?>
<html>



<form  method="post">
    <p>Ім'я:
        <input type="text" value="<?php echo $data[0][1] ?>" name="firstName" size="40"></p>
    <p>Прізвище:
        <input type="text" value="<?php echo $data[0][2] ?>" name="lastName" size="40"></p>
    <p>Email:
        <input type="text" value="<?php echo $data[0][7]?>" name="email" size="40"></p>
    <p>Номер телефону:
        <input type="text" value="<?php echo $data[0][4] ?>" name="phoneNum" size="40"></p>
    <p>Нікнейм:
        <input type="text" value="<?php echo $data[0][5] ?>" name="userName" size="40"></p>

    <p><input type="submit" name="Save" value="Зберегти">
        <input type="submit" name="Cancel" value="Відмінити">

</form>
</html>
