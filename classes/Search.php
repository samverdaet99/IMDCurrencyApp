<?php

include_once (__DIR__ . "/Db.php");


class zoekUser{


    public static function searchUser($searchField){

        Db::getConnection();

        $statement = $conn->prepare('select * from users where LOWER (username) LIKE LOWER :username');
        $statement->bindValue(':username' , '%' . searchField . '%');
        $statement->execute();

        $count = $statement->fetch(PDO::FETCH_ASSOC);
        return $count;

   
        

    }

}



 

 

?>


?>
