<?php
//include_once (__DIR__ . "/classes/User.php");
include_once (__DIR__ . "/classes/Transaction.php");

//$transfer = new Transaction();
session_start();

    $transfer = new Transaction();
    $allTransfers = $transfer->getTransfers();

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
    <title>IMDCurrency - details transfer</title>
</head>
<body>




<div id="terug"><a href="alletransacties.php">&#8592;</a></div>

<div id="paginatitel">
	<h1>Details transactie</h1>
	
</div>

<section id="kader_details">


<div id="details_kader">

<?php if(isset($emptymessage)) :?>
        <h2 class="emptyMessage"><?php echo $emptymessage; ?></h2>
    <?php endif; ?>   


<?php foreach ($allTransfers as $allTranser) :?>


  <div id="details_datum">
  <p> Uitvoerdatum: <br><?php echo $allTranser['datum'];?> </p>
  </div>




  <div id="details_gegevens">

  <p>Verzender: <br><?php echo $allTranser['user_verzender'];?></p>
  <p>Ontvanger: <br><?php echo $allTranser['user_ontvanger'];?> </p>



  <div id="details_bedrag">
  <p> Tokens: <br><?php echo $allTranser['bedrag'];?> </p>
  </div>


  

  <div id="details_beschrijving">
  <p> Beschrijving transactie: <br><?php echo $allTranser['description'];?> </p>
  </div>

  </div>
 
  <?php endforeach; ?>

      </div>
</div>



</section>

<div id="logout">
<a href="logout.php">
Uitloggen</a>
</div>
    
</body>
</html>