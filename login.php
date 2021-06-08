<?php
session_start();
$pdo = new PDO('mysql:host=librarysystem.cb82keujv05g.us-east-2.rds.amazonaws.com;port=3306;dbname=LibrarySystem', 'admin', '123va321si21_');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['submit'])) {
    // Витягаємо з бд

    $stmt = $pdo->query("SELECT Id,Password FROM User Where Username='" . $_POST['UserName'] . "'");
    $data = $stmt->fetchAll();

    $_SESSION['Username'] = $_POST['UserName'];
    // Порівнюємо паролі
    if ($data[0]['Password'] === md5(md5($_POST['Password']))) {


        $ip = $data['Id'];

        setcookie("ip", $data[0]['Id'], time() + 60 * 60 * 24 * 30, "/");

        // Передресація на мейн сторінку
        exit("<meta http-equiv='refresh' content='0; url=news.php'>");
    } else {
        print "Ви ввели неправильно нікнейм або пароль";
    }
}
session_destroy();
?>

<?php
require('components/header.php');
require('components/footer.php');
?>

<body>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
      integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<div class="container-login">
    <form method="POST">

        <div class="text-center mb-3">
            <img class="mb-4" src="img/LoginBut.png" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Вхід</h1>
        </div>

        <div class="form-label-group">
            <input type="text" name="UserName" class="form-control" placeholder="Логін" required="" autofocus="">
        </div>

        <div class="form-label-group">
            <input type="password" name="Password" class="form-control" placeholder="Пароль" required="">
        </div>

        <button class="btn btn-outline-dark" name="submit">Вхід</button>
    </form method="POST">
</div>
</body>

<style>
    .container-login {
        display: flex;
        justify-content: center;
        margin: auto;
        width: 30%;
        padding: 100px;
    }

    body {
        font-family: 'Playfair Display', serif;
    }

    * {
        box-sizing: content-box;
    }

    .form-control {
        border: 1px solid black;

        margin: 5px;
        padding: revert;
    }

    .btn {
        /*border: 1px solid #006b5d;*/
        margin-left: 80px;
        width: 40px;
    }
</style>

<!--<h2 style="text-align:center">Вхід</h2>-->
<!--<div class="center1">-->
<!--    <div>-->
<!--        <p>Логін :</p>-->
<!--        <p>Пароль:</p>-->
<!--    </div>-->
<!--    <form method="POST" class="input_data">-->
<!--        <p><input type="text" name="UserName" size="40"></p>-->
<!--        <p><input type="password" name="Password" size="40"></p>-->
<!---->
<!--        <form class="input_button">-->
<!--            <p>-->
<!--                <input class="input_button_button" name="submit" type="submit" value="Вхід">-->
<!--            </p>-->
<!--        </form method="POST">-->
<!--</div>-->
<!---->
<!---->
<!--<style>-->
<!---->
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
<!--    }-->
<!--</style>-->

