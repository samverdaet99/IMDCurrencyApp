<?php
include_once (__DIR__ . "/classes/User.php");
include_once (__DIR__ . "/classes/Transaction.php");
include_once (__DIR__ . "/classes/Search.php");



?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>IMDCurrency - alle transfers</title>
</head>
<body>


<div id="logout">
<a href="logout.php">
Uitloggen</a>
</div>

<a href="index.php">Terug</a>



<section id="kader_groot_transfer">


<div id="transactie_kader">

<div id="transactie_gegevens">
<p>Datum:</p>
<p>Verzender:</p>
<p>Ontvanger:</p>

<div id="transactie_bedrag">
<p> Bedrag: </p>
 </div>
<div id="transactie_details">
<p>Meer details >> </p>
</div>


</div>


</div>





</section>


    
</body>
</html>