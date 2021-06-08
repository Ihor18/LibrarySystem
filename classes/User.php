<?php
require_once 'Database.php';
class User extends DataBase
{
    protected $FirstName, $LastName,$Username;

    public function __construct()
    {
        $name = $this->doQuery("Select FirstName,LastName from User Where UserName='" . $_SESSION['Username'] . "'");
        $this->FirstName = $name[0][0];
        $this->LastName = $name[0][1];
        $this->Username=$_SESSION['Username'];
    }

    public function getFirstName()
    {
        return $this->FirstName;
    }

    public function getLastName()
    {
        return $this->LastName;
    }

    public function getInfo()
    {
        return $this->doQuery("Select * from User where UserName='" .$this->Username . "'");
    }


    public function update($Id, $FirstName, $LastName, $Email, $Number, $NickName)
    {
        $pdo = $this->connect();
        $stmt = $pdo->prepare("UPDATE User SET FirstName='$FirstName', LastName='$LastName', Email='$Email', MobilePhone='$Number',UserName='$NickName' WHERE Id=$Id");
        $stmt->execute();
    }
    public function isUsernameExist($Username){ /* Використовуємо при реєстарції */
        $id = $this->doQuery("Select id from User where UserName='" . $Username . "'");
        return $id[0][0];
    }
private function getNumberOfRecord($id){
    $data =  $this->doQuery("Select COUNT(*) from Record where UserId=$id");
    return $data[0][0];
}
    public function getRecordList($id){
        try{

            $list =  $this->doQuery("Select * from Record where UserId=$id");
            $count = $this->getNumberOfRecord($id);


            for ($i=0;$i<$count;$i++) {
                $BookData = $this->doQuery('Select BookName from Book Where Id=' . $list[$i][4]);
                echo 'Id ' . ($i + 1) . " Назва : <b>" ?>
                <html><a href="bookpage.php?book_id=<?php echo($list[$i][4]) ?>">
                </html><?php echo $BookData[$i][0] . '</b></a> Дата отримання: ' . date("d.m.y",strtotime($list[$i][1])). ' Дата повернення: ' . date("d.m.y",strtotime($list[$i][2])).'<br><br>';
            }

        }catch (Exception $a){
            echo 'Table is empty';
        }
    }
    public function getTypeList($id,$type){

try{
            $list =  $this->doQuery("Select * from StatusCheck where UserId=$id AND StatusBook='$type'");

            for ($i=0;$i<count($list);$i++) {
                $data = $this->doQuery('Select * from Book Where Id=' . $list[$i][3]);
                $AutorData =  $this->doQuery('Select FirstName,LastName from Author Where Id='.$data[$i][6]);
                echo 'Id '.($i+1)." Назва : <b>"?><html><a href="bookpage.php?book_id=<?php echo($data[$i][0]) ?>"></html>
                <?php echo $data[$i][1].'</b></a> Автор: '.$AutorData[0][0].' '.$AutorData[0][1].' Жанр: '.$data[$i][3].' Кількість сторінок: '.$data[$i][4].'<br><br>';

            }}catch (Exception $e){ ?>
<html><h3>Список порожній</h3> </html>
    <?php
        }


    }
}

class EditUser extends User{

    public function setEmail($Email){
        $pdo = $this->connect();
        $stmt = $pdo->prepare("UPDATE User SET Email='$Email' WHERE UserName='".$this->Username."'");
        $stmt->execute();
    }

    public function changePassword($newPassword){
        $pdo = $this->connect();
        $stmt = $pdo->prepare("UPDATE User SET Password='$newPassword' WHERE UserName='$this->Username'");
        $stmt->execute();
    }
    public function getPassword()
    {

        $password = $this->doQuery("Select Password from User where UserName='" . $this->Username . "'");
        return $password[0][0];
    }

}
$editUser = new EditUser();
$user = new User();