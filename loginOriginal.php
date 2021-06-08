<?php
session_start();
require('components/header.php');
require('components/footer.php');
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
        header("Location: news.php");
        exit();
    } else {
        print "Ви ввели неправильно нікнейм або пароль";
    }
}
session_destroy();
?>

<form method="POST">
    <p>UserName:
        <input type="text" name="UserName" size="40"></p>
    <p>Password:
        <input type="password" name="Password" size="40"></p>
    <input name="submit" type="submit" value="Вхід">
</form>


