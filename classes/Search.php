<?php

include_once(__DIR__ . "/Db.php");


class Search
{
    public static function findUser($searchField)
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM users WHERE LOWER(username) LIKE LOWER(:username)");
        $statement->bindValue(':username', $searchField);
        $statement->execute();
        $count = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $count;
    }

    public static function autocompleteClass($searchUser)
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT username FROM users WHERE LOWER(username) LIKE LOWER(:username)");
        $statement->bindValue(':username', '%' . $searchClass . '%');
        $statement->execute();
        $autocomplete = $statement->fetch(PDO::FETCH_ASSOC);
        return $autocomplete;
    }
}

