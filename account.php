<?php
session_start();
require('components/header.php');
require('components/footer.php');
require_once 'classes\User.php';
$_SESSION['error']=null;
if (!isset($_SESSION['Username'])) {
    die('Not logged in');
}
$oldpassword= $editUser->getPassword();
if($_POST['save']) {
    $_SESSION['error']='fsafas';
    if ($oldpassword == md5(md5(trim($_POST['OldPassword'])))) {
        if (strlen($_POST['Password2']) > 7) {
            if ($_POST['Password2'] == $_POST['Password2']) {
                $password = md5(md5(trim($_POST['Password2'])));
                $editUser->changePassword($password);
                $_SESSION['error'] = 'Пароль змінено';
                exit("<meta http-equiv='refresh' content='0; url=account.php'>");

            } else {
                $_SESSION['error'] = 'Паролі не співпадають';
            }
        } else {
            $_SESSION['error'] = 'Пароль повинен містити мінімум 8 символів';
        }
    }else{
        $_SESSION['error'] = 'Невірний пароль';
    }
}
if(strlen($_POST['email'])>5 && $_POST['submitEmail']){
    $editUser->setEmail($_POST['email']);
}

?>
<html>
<h2 class="H2centre"><?php print $user->getFirstName() . ' ' . $user->getLastName() ?></h2>
<head>
    <link href="https://allfont.ru/allfont.css?fonts=bikham-cyr-script" rel="stylesheet" type="text/css" />
<body>

<div class="menu">
<a href="formular.php">Список книжок</a><br>
<a href="favorite.php">Улюблені книги</a><br>
<a href="should_read.php">Хочу прочитати</a><br>
<a href="archive.php">Архів</a><br>
<a href="option.php">Налаштування</a><br>
<div class="poster">
    Змінити пароль
    <div class="descr">
        <form method="post" class="p">
            <p>Старий пароль:
                <input type="password"  name="OldPassword" size="40"></p>
            <p>Новий пароль:
                <input type="password"  name="Password1" size="40"></p>
            <p>Новий пароль:
                <input type="password"  name="Password2" size="40"></p>

            <p><input type="submit" name="save" value="Зберегти">
                <a style="margin-left: 20px; font-size: 14px "><?php  echo $_SESSION['error']?> </a>
            </p>
        </form>
    </div>
</div>
</div>
<div class="giveEmail">
    <p>Хочете отримувати новини щодо поповнення і рейтингу книг?<br> Залиште нам свою пошту</p>
    <form method="post">
        <input type="text" name="email" placeholder="Email">
        <input type="submit" name="submitEmail" value="Зберегти">
    </form>
</div>



<style>
    .menu{
        font-family: "Sitka Display";
        line-height: 1.5;
        margin-top: 5%;
        margin-left: 5%;
        font-size: 20px;
    }
    .p {
        text-align: left;
    }

    .poster {
        position: relative;

    }

    .descr {
        line-height: 1;
        display: none;
        font-size: 18px;
        padding: 10px;
        margin-top: 20px;
        background:  #F0F0EC; /*229,255,204 */
        height: 200px;
        -moz-box-shadow: 0 5px 5px rgba(0, 0, 0, 0.3);
        -webkit-box-shadow: 0 5px 5px rgba(0, 0, 0, 0.3);
        box-shadow: 0 5px 5px rgba(0, 0, 0, 0.3);
    }

    .poster:hover .descr {
        display: block;
        position: absolute;
        top: 1px;
        z-index: 9999;
        float: right;
height: 235px;
        width: 410px;
    }
</style>
<style>

    .giveEmail {
        margin-top: 13%;
        margin-left: 35%;
    }

    h2 {
        margin-top: 3%;
        font-size: 35px;
        margin-left: 40%;
    }
</style>
</body>
</head>

</html>
