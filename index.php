<?php
include_once(__DIR__ . '/classes/User.php');

$user = new User();
session_start();

if(isset($_SESSION['user'])){

    $username = $user->getUserByEmail($_SESSION['user']);
    $_SESSION['userid'] = $username['id'];

   
  } else {
    header("Location: inloggen.php");
  }


  ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>IMDcurrency App</title>


</head>
<body>

<div id="logout">
<a href="logout.php">
Uitloggen</a>
</div>

<div id="profielbox">

<div id="profieltekst">
    <h1>Lorem ipsum doleras lol!</h1>
    <h2 >Welkom, 
        <?php echo $username['username'];?>!
</h2>
    <p>Klik op onderstaande knoppen om een nieuwe transfer te maken <br>of om jouw vorige transfers te bekijken</p>

    <div id="huidigsaldo">

    <div id='huidigsaldotekst'>
    <h2>Jouw huidige saldo is</h2>
    <div id="huidigetokens" name="huidigetokens"></div>
    <h2>TOKENS</h2>
    </div>

    </div>

    <div id="links">

    <div id="nieuweTransfer">
        <a href="transfer.php">Maak een nieuwe transfer</a>
    </div>

    <div id="alleTransfers">
        <a href="">Bekijk alle transfers</a>
    </div>

    </div>

</div>
    
</div>
    
</body>


<!-- Tokens reload na 10 seconden -->

<script language="javascript">
sendRequest();
function sendRequest(){
    $.ajax({
        url: "autorefresh.php",
        success: 
        function(result){
            $('#huidigetokens').text(result); //insert text of test.php into your div
            setTimeout(function(){
                sendRequest(); //this will send request again and again;
            }, 10000);
        }
    });
}
</script>


</html>