
 <?php 

include_once(__DIR__ . '/classes/User.php');

$user = new User();
session_start();

if(isset($_SESSION['user'])){

    $username = $user->getUserByEmail($_SESSION['user']);
    $_SESSION['userid'] = $username['id'];
    echo $username['tokens']; 
   
  } else {
    header("Location: inloggen.php");
  }


