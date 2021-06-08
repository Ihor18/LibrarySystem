<?php
require('components/header.php');
require('components/footer.php');
$pdo = new PDO('mysql:host=librarysystem.cb82keujv05g.us-east-2.rds.amazonaws.com;port=3306;dbname=LibrarySystem', 'admin', '123va321si21_');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['Add'])) {
    $err = [];

    // перевіряємо нік
    if (!preg_match("/^[a-zA-Z0-9]/", $_POST['UserName'])) {
        $err[] = "Нікнейм може складатись тільки з англійського алфавіту та цифр";
    }

    if (strlen($_POST['UserName']) < 3 || strlen($_POST['UserName']) > 30) {
        $err[] = "Нікнейм не повинен бути меншим ніж 3 символи і не більше 30";
    }

    if ($_POST['Password1'] != $_POST['Password2']) {
        $err[] = "Паролі не співпадають";
    }
    $stmt = $pdo->query("SELECT * FROM User Where Username='" . $_POST['UserName'] . "'");
    $query = $stmt->fetchAll();

    if (is_null($query)) {
        $err[] = "Користувач з таким ніком уже існує";
    }

    // Якщо нема помилок, додаємо в бд нового користувача
    if (count($err) == 0) {

        $login = $_POST['UserName'];

        // Забераємо пробіли для хешування
        $password = md5(md5(trim($_POST['Password2'])));


        $stmt = $pdo->prepare('INSERT INTO `User` (FirstName,LastName, Age,MobilePhone,UserName,Password) VALUES ( :fn,:ln,:ag,:mp,:un,:ps)');
        $stmt->execute(array(
                ':fn' => $_POST['FirstName'],
                ':ln' => $_POST['SecondName'],
                ':ag' => $_POST['Age'],
                ':mp' => $_POST['Number'],
                ':un' => $_POST['UserName'],
                ':ps' => $password)
        );
        exit("<meta http-equiv='refresh' content='0; url=login.php'>");
    } else {
        print "<b>Помилка:</b><br>";
        foreach ($err as $error) {
            print $error . "<br>";
        }
    }
}
if (isset($_POST['Cancel'])) {
    exit("<meta http-equiv='refresh' content='0; url=news.php'>");
}
?>

<!--<h2 style="text-align:center">Реєстрація</h2>-->
<!--<div class="center1">-->
<!--    <div>-->
<!--        <p>Ім`я:</p>-->
<!--        <p>Прізвище:</p>-->
<!--        <p>Нікнейм:</p>-->
<!--        <p>Вік:</p>-->
<!--        <p>Номер телефону:</p>-->
<!--        <p>Пароль:</p>-->
<!--        <p>Введіть пароль повторно:</p>-->
<!--    </div>-->
<!--    <form method="post" class="input_data">-->
<!--        <p><input type="text" name="FirstName" size="40"></p>-->
<!--        <p><input type="text" name="SecondName" size="40"></p>-->
<!--        <p><input type="text" name="UserName" size="40"></p>-->
<!--        <p><input type="number" min="1" max="99" name="Age"></p>-->
<!--        <p><input type="text" name="Number"></p>-->
<!--        <p><input type="password" name="Password1"></p>-->
<!--        <p><input type="password" name="Password2"></p>-->
<!---->
<!--        <form class="input_button">-->
<!--            <p>-->
<!--                <input class="input_button_button" type="submit" name="Add" value="Ок">-->
<!--                <input class="input_button_button" type="submit" name="Cancel" value="Скасувати">-->
<!--            </p>-->
<!--        </form method="post">-->
<!--</div>-->
<!---->
<!--<style>-->
<!--    .center1 {-->
<!--        margin: auto;-->
<!--        width: 66%;-->
<!--    }-->
<!---->
<!--    .center1 div {-->
<!--        width: 45%;-->
<!--        text-align: right;-->
<!--        float: left;-->
<!--    }-->
<!---->
<!--    h2 {-->
<!--        margin: 10px auto;-->
<!--        margin-top: 70px;-->
<!--        width: 66%;-->
<!--    }-->
<!---->
<!--    input {-->
<!--        width: 100%;-->
<!--        margin: 0;-->
<!--    }-->
<!---->
<!--    form.input_data {-->
<!--        width: 54%;-->
<!--        display: block;-->
<!--        float: right;-->
<!--    }-->
<!---->
<!--    form p {-->
<!--        margin-block-start: 0.65em;-->
<!--        margin-block-end: 0.2em;-->
<!--    }-->
<!---->
<!--    .input_button {-->
<!--        width: 55%;-->
<!--        text-align: center;-->
<!--        float: right;-->
<!--    }-->
<!---->
<!--    .input_button_button {-->
<!--        width: 33%;-->
<!--        color: #000000;-->
<!---->
<!--    }-->
<!--</style>-->

<body>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
      integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<div class="container-reg">
    <form method="POST">
        <div class="text-center mb-4">
            <img class="mb-4" src="img/LoginBut.png" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Регістрація</h1>
        </div>

        <div class="form-label-group">
            <input type="text" name="FirstName" class="form-control" placeholder="Ім'я" required=""
                   autofocus="">
        </div>
        <div class="form-label-group">
            <input type="text" name="SecondName" class="form-control" placeholder="Прізвище" required=""
                   autofocus="">
        </div>

        <div class="form-label-group">
            <input type="text" name="UserName" class="form-control" placeholder="Нікнейм" required=""
                   autofocus="">
        </div>
        <div class="form-label-group">
            <input type="number" min="1" max="99" name="Age" class="form-control" placeholder="Вік" required=""
                   autofocus="">
        </div>

        <div class="form-label-group">
            <input type="text" name="Number" class="form-control" placeholder="Номер телефону" required=""
                   autofocus="">
        </div>

        <div class="form-label-group">
            <input type="password" name="Password1" class="form-control" placeholder="Пароль" required=""
                   autofocus="">
        </div>

        <div class="form-label-group">
            <input type="password" name="Password2" class="form-control" placeholder="Введіть пароль повторно"
                   required="">


            <button class="btn btn-outline-dark" type="submit" name="Add">Ок</button>
            <button class="btn btn-outline-dark" type="submit" name="Cancel">Скасувати</button>
    </form method="POST">
</div>
</body>

<style>

    body {
        width: 100%;
        font-family: 'Playfair Display', serif;
    }

    * {
        box-sizing: content-box;
    }

    .container-reg {
        display: flex;
        justify-content: center;
        margin: auto;
        width: 30%;
        padding: 50px;
    }

    .form-control {
        border: 1px solid black;
        margin: 5px;
        padding: revert;
    }

    .btn {
        /*border: 1px solid #006b5d;*/
        margin-left: 23px;
        width: 65px;
    }
</style>