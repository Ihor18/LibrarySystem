<?php
$target_dir = "img/cover/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
//перевірка на зображення
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "Файл - " . $check["mime"] . "<br>";
        $uploadOk = 1;
    } else {
        echo "Файл не зображення<br>";
        $uploadOk = 0;
    }
}
//перевірка розміру 
if ($_FILES["fileToUpload"]["size"] / 1024 > 1024) {
    echo "Файл більше 1 Мб, стисніть його<br>";
    $uploadOk = 0;
} else {
    echo sprintf("%.1f kB <br>", $_FILES["fileToUpload"]["size"] / 1024);
}

//перевірка формату
if ($imageFileType != "png") {
    echo "Дозволено тільки PNG файли<br>";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Вибачте, ваш файл не завантажено<br>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "Файл " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " завантажено<br>";
    } else {
        echo "Виникла помилка, ваш файл не завантажило(";
    }
}
?>