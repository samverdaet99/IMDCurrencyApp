<?php
include_once (__DIR__ . "/classes/User.php");
include_once (__DIR__ . "/classes/Transaction.php");
 

session_start();

    $transfer = new Transaction();
    $allTransfers = $transfer->getTransfers();

    $user = new User();

    $transactieVerzender = Transaction::transactiesVerzender($transfer);
    $transactieOntvanger = Transaction::transactiesOntvanger($transfer);

  
   // $user = Transaction::findUser($transfer);

    if ($allTransfers == null)
    {
    $emptymessage = "Nog geen transacties";
    }


  ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>IMDCurrency - Details</title>
</head>
<body>


<div id="terug"><a href="alletransacties.php">&#8592;</a></div>


<div id="paginatitel">
	<h1>Details</h1>
	<p>Hieronder vindt u een gedetailleerde weergave van de transacties.</p>
</div>

<section id="kader_details">

<div id="details_kader">

<?php


$detWeergeven = Transaction::showDetails($_GET['id']);
var_dump($detWeergeven);


?>


<div id="details_bedrag">
  <p> Tokens: <br><?php echo $detWeergeven['bedrag']?> </p>
  </div>

<?php

?>




</div>


 

</section>    


    
</body>
</html>