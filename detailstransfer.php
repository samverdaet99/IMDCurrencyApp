<?php
//include_once (__DIR__ . "/classes/User.php");
include_once (__DIR__ . "/classes/Transaction.php");

$transfer = new Transaction();

session_start();

if(isset($_SESSION['transfer'])){

    $transfer = new Transaction();

    $allTransfers = $transfer->getTransfers($_SESSION['transfer']);
   
  } else {
    //header("Location: transfer.php");
  }


  ?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>IMDCurrency - details transfer</title>
</head>
<body>


<div id="logout">
<a href="logout.php">
Uitloggen</a>
</div>

<a href="alletransacties.php">Terug</a>



<section id="kader_details">

<div id="details_kader">

<?php if(isset($emptymessage)) :?>
        <h2 class="emptyMessage"><?php echo $emptymessage; ?></h2>
    <?php endif; ?>   


<?php foreach ($allTransfers as $allTranser) :?>


  <div id="details_datum">
  <p> Uitvoerdatum:<?php echo $allTranser['datum'];?> </p>
  </div>




  <div id="transactie_gegevens">

  <p>Verzender: <?php echo $allTranser['user_verzender'];?></p>
  <p>Ontvanger: <?php echo $allTranser['user_ontvanger'];?> </p>



  <div id="transactie_bedrag">
  <p> Tokens :<?php echo $allTranser['bedrag'];?> </p>
  </div>

  <div id="transactie_beschrijving">
  <p> Beschrijving transactie :<?php echo $allTranser['description'];?> </p>
  </div>

  </div>
 
  <?php endforeach; ?>

    </div>
</div>



</section>


    
</body>
</html>