<?php
include_once(__DIR__ . '/classes/User.php');

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
    <p>USERNAME</p>

    <div id="huidigsaldo">

    <div id='huidigsaldotekst'>
    <h2>Jouw huidige saldo is</h2>
    <div id="huidigetokens"> 45</div>
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
</html>