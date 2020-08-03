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
    <div id="huidigetokens"></div>
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

<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
$document.ready(function(){
    $("#huidigetokens").load("autorefresh.php");
    setInterval(function(){
        $("#huidigetokens").load("autorefresh.php");
    }, 3000);
});


</script>
    
</body>
</html>