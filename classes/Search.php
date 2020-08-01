<?php

include_once (__DIR__ . "/Db.php");

$output="";

if (isset($_POST['search'])){
    $searchq = $_POST['search'];
    $searchq = preg_replace("#0-9a-z#i","",$searchq);

    //$query = mysql_query("SELECT * FROM members WHERE username LIKE '%$searchq%'") or die("could not seacrh");

    $conn = Db::getConnection();
    $query = $conn->prepare("SELECT * FROM members WHERE username LIKE '%$searchq%'") or die("could not seacrh");
 


    $count = mysqli_num_rows($query);

    if ($count == 0){
        $output = "there was no search results!";
    } else {
        while($row = mysqli_fetch_array($query)){
            $uName = $row['username'];
            $id = $row['id'];

            $output .= '<div>' .$uName. '</div>';
        }
    }

}

?>
