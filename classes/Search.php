<?php

include_once (__DIR__ . "/Db.php");


class searchUser{


    public function searchUser($searchField){

        $conn = Db::getConnection();

        $statement = $conn->prepare('select * from users where LOWER (username) LIKE LOWER :username');
        $statement->bindValue(':username' , '%' . searchField . '%');
        $statement->execute();

        $count = $statement->fetch(PDO::FETCH_ASSOC);
        return $count;

   
        

    }



    public static function autocompleteSearchUser(){

        $conn = Db::getConnection();
        $statement = ("SELECT username, id FROM users WHERE username LIKE :username LIMIT 1");
        $query = $conn->prepare($statement);

        $query->bindValue(':username', $input, '%');
        $query->execute();

        $suggestion = $query->fetch(PDO::FETCH_ASSOC);

        return $suggestion;

    }

}



 

 

?>


?>
