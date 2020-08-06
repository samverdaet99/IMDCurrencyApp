<?php
include_once (__DIR__ . "/classes/User.php");
include_once (__DIR__ . "/classes/Transaction.php");

$transfer = new Transaction();
session_start();

if(isset($_SESSION['transfer'])){
  //if (!empty($_POST)) {

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


<div id="terug"><a href="index.php">&#8592;</a></div>


<div id="paginatitel">
	<h1>Mijn  transacties</h1>
	<p>Hieronder vindt u een weergave van de transacties die u reeds uitvoerde.</p>
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

<div class="btndetails"><a href="detailstransfer.php">Bekijk details</a></div>

</div>
 
  <?php endforeach; ?>

      </div>
</div>



</section>






     


    
</body>
</html>