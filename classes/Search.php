<?php

include_once (__DIR__ . "/Db.php");


class zoekUser{

    public static function searchUser($username){

        Db::getConnection();

        $statement = $conn->prepare('select * from users where LOWER (username) LIKE LOWER :username');
        $statement->bindParam(':username' , '%' . searchField . '%');
        $statement->execute();

        $res = $statement->fetch(PDO::FETCH_ASSOC);
        return $res;

   
        

    }

}



 

 

?>


?>
