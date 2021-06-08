<?php
require_once 'Database.php';
class Admin extends DataBase{
    public function findUser($query){
        $data =  $this->doQuery($query);

        for($i=0;$i<count($data);$i++){
            $count= $this->doQuery("Select Count(*) from Record where UserId=".$data[$i][0]);
            if($count[$i][0]==null){
                $count[$i][0]=0;
            }
            echo 'Id '.($i+1)." Нікнейм : "?><html><a href="userpage.php?id=<?php echo $data[$i][0]?>"><? echo $data[$i][5]?></a></html><?php echo "  Ім'я ".$data[$i][1].'  '.$data[$i][2].' Кількість книжок: '.$count[$i][0].'<br><br>' ;


        }
    }




}
$admin = new Admin();