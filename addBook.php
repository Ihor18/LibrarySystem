<?php
session_start();
$err=[];

$_SESSION['message']='';
require_once 'classes\Catalog.php';
require_once 'components\header.php';

if(!$_SESSION['Username']=='admin'){
    die('Access denied');
}

if($_POST['submit']){
    if(strlen($_POST['BookName'])<1){
        $err[]='Заповніть назву книги';
    }
    if(strlen($_POST['AuthorFirstName'])<1){
        $err[]="Заповніть ім'я автора";
    }
    if(strlen($_POST['AuthorSecondName'])<1){
        $err[]="Заповніть прізвище автора";
    }
    if(strlen($_POST['Publishing'])<1){
        $err[]="Заповніть назву видавництва";
    }
    if(strlen($_POST['Genre'])<1){
        $err[]="Вкажіть жанр";
    }
    if(!is_numeric($_POST['PageNumber'])){
        $err[]="Кількість сторінок має бути числом";
    }
    if(!is_numeric($_POST['InStock'])){
        $err[]="Поле 'В наявності' має бути числом";
    }

//титулка
    $target_dir = "img/cover/";//папка з титулками
    $target_file = $target_dir . $_POST["BookName"] . ".png";//файл конкретної титулки
    $imageFileType = strtolower(pathinfo($target_dir . basename($_FILES["FileToUpload"]["name"]), PATHINFO_EXTENSION));//тип файлу
    $check = getimagesize($_FILES["FileToUpload"]["tmp_name"]);
    if($check !== false) {
    } else {
        $err[] = "Файл не зображення";
    }
    if ($_FILES["FileToUpload"]["size"]/1024 > 1024) {
        $err[] = "Файл більше 1 Мб, стисніть його";
    }
    if($imageFileType != "png") {
        $err[] =  "Дозволено тільки PNG файли";
    }
//кінець перевірки титулки

    if(count($err)==0) {
        if ($createCatalog->findAuthor($_POST['AuthorFirstName'], $_POST['AuthorSecondName'])) {
            $createCatalog->createBook($_POST['BookName'],$_POST['AuthorFirstName'], $_POST['AuthorSecondName'],$_POST['Publishing'],$_POST['Genre'],$_POST['PageNumber'],$_POST['InStock']);
            move_uploaded_file($_FILES["FileToUpload"]["tmp_name"], $target_dir . $createCatalog->getLastId() . ".png");
            $_SESSION['message']='Книгу успішно додано!<br>';
            exit("<meta http-equiv='refresh' content='0; url=catalog.php'>");
        } else {
            $err[] = "Автора не має в базі даних!";
        }
    }

}
if($_POST['cancel']){
    exit("<meta http-equiv='refresh' content='0; url=catalog.php'>");
}
?>
<script>
    document.title = 'Додати книгу';
</script>
<div class="container">
    <h2 style="text-align:center;font-size:1.5em;margin-bottom:0;">Додати книгу</h2>
    <a style="color:green"><?php
        echo $_SESSION['message'];
        ?>
    </a>
    <a style="color:red"><?php
        foreach($err AS $error)
        {
            print  $error."<br>";
        }
        echo '<br>';
        ?>
    </a>
    <div style="
		float:left;
		width:40%;
		box-sizing:border-box;
		text-align:right;
		font-size:20px;
		line-height:20px;
	">
        <p>Назва: </p>
        <p>Ім'я письменника: <p>
        <p>Прізвище письменника: <p>
        <p>Видавництво: <p>
        <p>Жанр: <p>
        <p>Кількість сторінок: <p>
        <p>В наявності: <p>
        <p>Зображення титулки: <p>
    </div>
    <form style="
		float:right;
		width:60%;
		box-sizing:border-box;
		margin:0 auto;
		text-align:left;
		padding-left:0.5em;
		" method="post" enctype="multipart/form-data">
        <p>
            <input type="text" name="BookName" size="40"></p>
        <p>
            <input type="text" name="AuthorFirstName" size="40"></p>
        <p>
            <input type="text" name="AuthorSecondName" size="40"></p>
        <p>
            <input type="text" name="Publishing" size="40"></p>
        <p>
            <input type="text" name="Genre" size="40"></p>
        <p>
            <input type="text" name="PageNumber"></p>
        <p>
            <input type="text" name="InStock"></p>
        <p>
            <input type="file" name="FileToUpload"></p>
        <p><input type="submit" name="submit" value="Додати">
            <input type="button" name="cancel" value="Відмінити">
    </form>
</div>
<?php
require_once 'components\footer.php';
?>

