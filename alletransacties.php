<?php
//include_once (__DIR__ . "/classes/User.php");
include_once (__DIR__ . "/classes/Transaction.php");

$transfer = new Transaction();
session_start();

if(isset($_SESSION['transfer'])){

    $transfer = new Transaction();

    $allTransfers = $transfer->getTransfers($_SESSION['transfer']);

    if ($allTransfers == null)
    {
    $emptymessage = "Nog geen transacties";
    }
   
  } else {
    //header("Location: alletransacties.php");
  }


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



<section id="kader_groot_transfer2">


<div id="transactie_kader">

<?php if(isset($emptymessage)) :?>
        <h2 class="emptyMessage"><?php echo $emptymessage; ?></h2>
    <?php endif; ?>   


<?php foreach ($allTransfers as $allTranser) :?>

  <div id="transactie_datum"><p><?php echo $allTranser['datum']; ?></p></div>



  <div id="transactie_gegevens">

  <p>Verzender: <?php echo $allTranser['user_verzender'];?></p>
  <p>Ontvanger: <?php echo $allTranser['user_ontvanger'];?> </p>



  <div id="transactie_bedrag">
  <p> Tokens :<?php echo $allTranser['bedrag'];?> </p>
  </div>

  
  <div id="transactie_details">
  <a href="detailstransfer.php">Meer details >></a>
  </div>
 
  <?php endforeach; ?>




</div>


</div>





</section>


    
</body>
</html>