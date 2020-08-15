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
//var_dump($detWeergeven);

foreach($detWeergeven as $detWeergeven2) { ?>


<div id="details_bedrag">

<?php
$details=$transfer->showDetails($detWeergeven2['id']);
?>


<div id="details_datum">
  <p> Uitvoerdatum: <br><?php echo $detWeergeven2['datum']?> </p>
  </div>


  <div id="details_gegevens">

 
        
<?php 
{
    
     ?>

        <?php echo  " verzender: ";
         echo $detWeergeven2['user_verzender'];
          
              
        
} 
{                  echo  "<br> ontvanger: ";
              echo $detWeergeven2['user_ontvanger']; ; ?>


    <?php           
} 
?>


<div id="details_bedrag">
  <p> Tokens: <br><?php echo $detWeergeven2['bedrag']?> </p>
  </div>


  <div id="details_beschrijving">
  <p> Tokens: <br><?php echo $detWeergeven2['description']?> </p>
  </div>


  
  </div>

<?php
}
?>




</div>


 

</section>    


    
</body>
</html>