<?php

include_once(__DIR__ . "/Db.php");

class Search {

    public static function searchName($searchField)
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM users WHERE LOWER(username) LIKE LOWER(:username) ");
        $statement->bindValue(':username', '%' . $searchField . '%');
        $statement->execute();
        $count = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $count;
    }

    public static function autocompleteSearchName($input)
    {
        $conn = Db::getConnection();
        $statement = ("SELECT username FROM users WHERE username LIKE :username  :username LIMIT 1");
        $query = $conn->prepare($statement);
        $query->bindValue(':username', $input . '%');
        $query->execute();

        $suggestion = $query->fetch(PDO::FETCH_ASSOC);

        return $suggestion;
    }
}
