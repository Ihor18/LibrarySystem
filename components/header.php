<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Бібліотека Не_Рви</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="img/storytelling.png">
<!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">-->
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=EB+Garamond:wght@500&display=swap');
</style>
<body>
<header class="site-header">
    <nav class="site-navigation">
        <a class="logo-link" href="index.php">
            <img src="img/logo-full.png" alt="Логотип бібліотеки Не_Рви">
        </a>
        <ul class="navigation-list">
            <li><a href="catalog.php">Каталог</a></li>
            <li><a href="services.php">Послуги</a></li>
            <li><a href="contacts.php">Контакти</a></li>
            <?php
            if (!isset($_SESSION['Username'])) { ?>
                <li><a href="login.php">Вхід</a></li>
                <li><a href="register.php">Реєстрація</a></li>
            <?php } else { ?>
            <li><a href="logout.php">Вихід</a></li>
            <li><a href="account.php">Особистий кабінет</a>
            </li>
            <?php
            if (($_SESSION['Username'])=='admin') { ?>
                <li><a href="AdminPanel.php">Адмін панель</a></li>
            <?php }else{ ?>
            <li><a ><?php
                    echo $_SESSION['Username'];
                    }
            } ?></a></li>

        </ul>
    </nav>
</header>

