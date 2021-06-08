<?php
session_start();
require_once 'classes\Catalog.php';
require_once 'components\header.php';
?>

<script>document.title = 'Каталог'</script>
<div style="
	width:90%;
	margin:0 auto;
	">
    <div style="
		width:20%;
		float:left;
		padding-top:2em;
		">
        <?php
        if ($_SESSION['Username'] == 'admin'){ ?>
        <p>
            <a href="addBook.php">Add New Entry</a><br>
            <a href="addAutor.php">Add New Author</a><br>
            <a style="color:green"><?php echo $_SESSION['message'];
                } ?>
        </p>
        <a style="color:green"><?php require_once 'components\GenresList.php';
            $_SESSION['message'] = '';
            if (!isset($_POST['GenresList'])) {
                $_POST['GenresList'] = 'Усі книги';
            }
            echo $_POST['GenresList'];
            if (empty($_POST['SearchBookForm'])) {
                switch ($_POST['GenresList']) {
                    case 'Усі книги':
                        $query = 'Select * from Book';
                        break;
                    case 'Детектив':
                        $query = "Select * from Book where Genre ='Детектив'";
                        break;
                    case 'Трилер':
                        $query = "Select * from Book where Genre ='Трилер'";
                        break;
                    case 'Фантастика':
                        $query = "Select * from Book where Genre ='Фантастика'";
                        break;
                    case 'Жахи':
                        $query = "Select * from Book where Genre ='Жахи'";
                        break;
                    case 'Фентезі':
                        $query = "Select * from Book where Genre ='Фентезі'";
                        break;
                    case 'Драма':
                        $query = "Select * from Book where Genre ='Драма'";
                        break;
                    case 'Наука':
                        $query = "Select * from Book where Genre ='Наука'";
                        break;
                    case 'Інше':
                        $query = "Select * from Book where Genre !='Наука' AND Genre !='Детектив' AND Genre !='Трилер' 
					AND Genre !='Фантастика' AND Genre !='Жахи' AND
					Genre !='Фентезі' AND Genre !='Драма'";
                        break;
                }
            } else {
                $query = "Select * from Book where BookName Like '%" . $_POST['SearchBookForm'] . "%'";
            }
            ?></a>
    </div>
    <div style="
	width:80%;
	padding:0.5em;
	float:right;
	">
        <h2>Каталог</h2>
        <p1>
            <?php
            $catalog->datatable($query);
            $_POST['SearchBookForm'] = NULL;
            ?>
        </p1>
    </div>
</div>
<?php require_once 'components\footer.php'; ?>


<style>
.poster{
position:relative;
margin:100px auto;
background:#ff6600;
height:200px;
width:150px;
}
.descr{
display:none;
margin-left:-350px;
padding:10px;
margin-top:17px;
background:#f3f3f3;
height:200px;
-moz-box-shadow:0 5px 5px rgba(0,0,0,0.3);
-webkit-box-shadow:0 5px 5px rgba(0,0,0,0.3);
box-shadow:0 5px 5px rgba(0,0,0,0.3);
}
.poster:hover .descr{
display:block;
position:absolute;
top:120px;
z-index:9999;
width:400px;
}
.intro p1 {
    width: 210px;
    margin: 8px 0 10px;
    padding: 0;
    line-height: 20px;