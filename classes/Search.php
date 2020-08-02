<?php

include_once (__DIR__ . "/Db.php");

$conn = Db::getConnection();

$searchq = $_POST['search'];
$searchq = preg_replace("#0-9a-z#i","",$searchq);

//$query = mysql_query("SELECT * FROM members WHERE username LIKE '%$searchq%'") or die("could not seacrh");
$query = $conn->prepare("SELECT * FROM users WHERE username LIKE '%$searchq%'") or die("could not seacrh");



$output = '';
//$searchq = $_POST['search'];
//$sql = "SELECT * FROM users WHERE username LIKE '%$searchq%'";

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0){
    $output .= '<h4>Gebruiker</h4>';


while ($row = mysqli_fetch_array($result)){
    $output .= '<p>' .$row["username"].'<p>';
     
}
echo $output;
}
else{
    echo 'Gebruiker niet teruggevonden';
}


?>
