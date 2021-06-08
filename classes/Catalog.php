<?php

require_once 'Database.php';

class Catalog extends Database
{
    
    public function datatable($query){

        try{

         $data =  $this->doQuery($query);


            for ($i=0;$i<count($data);$i++){
                $AutorData =  $this->doQuery('Select FirstName,LastName from Author Where Id='.$data[$i][6]);
                echo 'Id '.($i+1)." Назва : <b>"?><html><a href="bookpage.php?book_id=<?php echo($data[$i][0]) ?>"></html><?php echo $data[$i][1].'</b></a> Автор: <b>'.$AutorData[0][0].' '.$AutorData[0][1].'</b> Видавництво: '.$data[$i][2].' Жанр: '.$data[$i][3].' Кількість сторінок: '.$data[$i][4].' В наявності: '.$data[$i][5];
                if( $_SESSION['Username']=='admin') {
                    ?>

                    <html>
                    <a href="edit.php?book_id=<?php echo($data[$i][0]) ?>">Edit</a>/<a
                        href="delete.php?book_id=<?php echo($data[$i][0]) ?>">Delete</a>
                    <br><br></html>
                    <?php
                }else{
                    echo '<br> <br>';
                }
            }
        }catch (Exception $a){
            echo 'Table is empty';
        }

}

}

class CreateCatalog extends Catalog {

   public function findAuthor($FirstName,$LastName){
	$data=$this->doQuery("Select * from Author where FirstName ='".$FirstName."' And LastName='".$LastName."'");
	if(empty($data)){
		return false;
	}else{
		return true;
	}
   }
   public function createBook($BookName,$FirstName,$LastName,$Publishing,$Genre,$PageNumber,$InStock){

       $data=$this->doQuery("Select Id from Author where FirstName ='".$FirstName."' And LastName='".$LastName."'");
       $AuthorId=$data[0][0];
	$pdo=$this->connect();
       $stmt = $pdo->prepare('INSERT INTO Book
        (BookName,publishing,Genre,AmountOfPages,InStock,AuthorId) VALUES ( :bn,:pb,:gn,:pn,:st,:ai)');
       $stmt->execute(array(
               ':bn' => $BookName,
               ':pb' => $Publishing,
               ':gn' => $Genre,
                ':pn' => $PageNumber,
                ':st' => $InStock,
                'ai' =>$AuthorId
       ));
   }
   public function getLastId(){	   
	   $data = $this->doQuery("Select Max(id) From Book");
	   return $data[0][0];
	}
   public function isAuthor($FirstName,$LastName){
       $pdo=$this->connect();
       $data=$this->doQuery("Select FirstName,LastName from Author where FirstName ='".$FirstName."' And LastName='".$LastName."'");
       if(!empty($data)){
           return true;
       }else{
           return false;
       }
   }
    public function createAuthor($FirstName,$LastName,$About){
        $pdo=$this->connect();

        $stmt = $pdo->prepare('INSERT INTO Author
        (FirstName,LastName,Description) VALUES ( :fn,:ln,:ab)');
        $stmt->execute(array(
            ':fn' => $FirstName,
            ':ln' => $LastName,
            ':ab' => $About
        ));
    }

}

class Review extends Catalog{
	public function createReview($ReviewText,$UserName,$BookId){
        $pdo=$this->connect();
		$UserId = $this->doQuery("Select Id From User WHERE UserName = '" . $UserName . "'");
        $stmt = $pdo->prepare('INSERT INTO Review (ReviewText, UserId, BookId, ReviewDate) VALUES (:rt,:ui,:bi, DATE_FORMAT(NOW(), \'%H:%i:%s, %d/%m/%y\'))');
        $stmt->execute(array(
            ':rt' => $ReviewText,
            ':ui' => $UserId[0][0],
            ':bi' => $BookId
        ));
    }
	public function getReview($BookId){
        $pdo=$this->connect();
		$reviewData = $this->doQuery("Select * From Review WHERE BookId = " . $BookId);
		if(empty($reviewData))return 0;
		else return $reviewData;
    }
	public function getUserName($usrid){
        $pdo=$this->connect();
		$revUserName = $this->doQuery("Select UserName From User WHERE Id = " . $usrid);		
		return $revUserName[0][0];
    }
	public function getStatus($UserName, $BookId){
		$pdo=$this->connect();
		$UserId = $this->doQuery("Select Id From User WHERE UserName = '" . $UserName . "'");
		return $this->doQuery("Select * From StatusCheck WHERE UserId = " . $UserId[0][0] . " AND BookId = " . $BookId);
	}
	public function setStatus($Status, $UserName, $BookId){
		$pdo=$this->connect();
		$status = $this->getStatus($UserName, $BookId);
		$used = false;
		for($i = 0; $i < count($status); $i++){
			if($status[$i][1] == $Status){
				$stmt = $pdo->prepare("DELETE FROM StatusCheck WHERE Id = ".$status[$i][0]);//"StatusBook = '".$Status."' AND UserId = ".$status[$i][2]." AND BookId");
				$stmt->execute();
				$used = true;				
				break;
			}
		}
		if(!$used){
			$UserId = $this->doQuery("Select Id From User WHERE UserName = '" . $UserName . "'");
			$stmt = $pdo->prepare("INSERT INTO StatusCheck (StatusBook, UserId, BookId) VALUES ('".$Status."',:ui,:bi)");
			$stmt->execute(array(
            ':ui' => $UserId[0][0],
            ':bi' => $BookId
        ));
		}
	}
}

class EditAndDelete extends Catalog {
    public function findBookName($id){
        $pdo=$this->connect();
        $data=$this->doQuery('Select BookName from Book where Id='.$id);
        return $data;
    }
	public function delete ($id){
		$pdo=$this->connect();
		$stmt = $pdo->prepare("DELETE FROM Book WHERE Id=".$id);
		$stmt->execute();
	}
	public function getInfo($id){
	    return $this->doQuery("Select * from Book where Id=".$id);
	}
	public function getAuthor($id){
		return $this->doQuery("Select * from Author where Id=".$id);
	}
	public function edit($BookName,$Publishing,$Genre,$PageNum,$inStock,$id){
		$pdo=$this->connect();
		$stmt = $pdo->prepare("UPDATE Book SET BookName='".$BookName."', publishing='".$Publishing."', Genre='".$Genre."', AmountOfPages=".$PageNum.",InStock=".$inStock." WHERE Id=".$id);
		$stmt->execute();
	}
}
$editAndDelete = new EditAndDelete();
$createCatalog = new CreateCatalog();
$catalog = new Catalog();
$review = new Review();
