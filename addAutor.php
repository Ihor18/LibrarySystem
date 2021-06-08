<?php

session_start();
$err = [];
require_once 'classes\Catalog.php';
require_once 'components\header.php';
if ($_POST['submit']) {
    if (strlen($_POST['AuthorFirstName']) < 1) {
        $err[] = "Заповніть ім'я автора";
    }
    if (strlen($_POST['AuthorSecondName']) < 1) {
        $err[] = "Заповніть прізвище автора";
    }
    if (strlen($_POST['About']) < 1) {
        $err[] = "Запишіть кілька слів про автора";
    }
    if (count($err) == 0) {
        $isAuthor = $createCatalog->isAuthor($_POST['AuthorFirstName'], $_POST['AuthorSecondName']);
        if ($isAuthor) {
            $err[] = "Такий автор уже існує в базі данних";
        } else {
            $createCatalog->createAuthor($_POST['AuthorFirstName'], $_POST['AuthorSecondName'], $_POST['About']);
            $_SESSION['message'] = "Автора успішно додано!<br>";
            exit("<meta http-equiv='refresh' content='0; url=catalog.php'>");

        }
    }
}
if ($_POST['cancel']) {
    exit("<meta http-equiv='refresh' content='0; url=catalog.php'>");
}

?>

<html>
<head>
    <title>Додати Автора</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
          integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<body>
<div>
    <h2>Додати книгу</h2>
    <a style="color:red"><?php
        foreach ($err as $error) {
            print  $error . "<br>";
        }
        echo '<br>';
        ?>
    </a>
    <a style="color:green"><?php
        echo $_SESSION['message'];
        ?>
    </a>
    <form method="post">

        <p>Ім'я письменника:
            <input type="text" name="AuthorFirstName" size="40"></p>
        <p>Прізвище письменника:
            <input type="text" name="AuthorSecondName" size="40"></p>
        <p>Про письменника:
            <input type="text" name="About" size="300"></p>

        <p><input type="submit" name="submit" value="Add">
            <input type="submit" name="cancel" value="Cancel">

    </form>
</div>
</body>
</html>