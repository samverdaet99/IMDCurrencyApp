<?php
include_once (__DIR__ . "/classes/User.php");
include_once (__DIR__ . "/classes/Transaction.php");
 
  
session_start();


    $transfer = new Transaction();
    $allTransfers = $transfer->getTransfers();

  // NB: OM USERNAMES TE LATEN ZIEN ZOU IK DEZE FUNCTIE GEBRUIKEN, HET IS MIJ ECHTER NOOIT GELUKT OM DEZE 100% WERKEND TE KRIJGEN, VANDAAR DAT IK HET MET DE ID'S HEB GEDAAN.
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
    <title>IMDCurrency - alle transfers</title>
</head>
<body>


<div id="terug"><a href="index.php">&#8592;</a></div>

<div id="paginatitel">
	<h1>Mijn  transacties</h1>
	<p>Hieronder vindt u een weergave van de transacties die u reeds hebt uitgevoerd.</p>
</div>

<section id="kader_details">

  


  

<div id="details_kader">

<?php if(isset($emptymessage)) :?>
        <h2 class="emptyMessage"><?php echo $emptymessage; ?></h2>
    <?php endif; ?>   

    <!--
      NB: OM USERNAMES TE LATEN ZIEN ZOU IK DEZE FUNCTIE GEBRUIKEN, HET IS MIJ ECHTER NOOIT GELUKT OM DEZE 100% WERKEND TE KRIJGEN, VANDAAR DAT IK HET MET DE ID'S HEB GEDAAN.


      for($i= 1, $count = count($transactieOntvanger);$i<$count;$i++):
          $transactieOntvangers = $transactieOntvanger[$i];
          $transactieVerzenders = $transactieVerzender[$i];

      

      if (($transactieOntvangers['user_ontvanger']  == $_SESSION['userid']) || ($transactieVerzenders['user_verzender'] == $_SESSION['userid'])){

-->

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