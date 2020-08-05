<?php
include_once (__DIR__ . "/classes/User.php");
include_once (__DIR__ . "/classes/Transaction.php");

$user= new User();

session_start();

if(isset($_SESSION['user'])){

    $allTransfers = $user->getTransfers($_SESSION['user']);
    $getTransfer = $user->getTransfer($_SESSION['user']);

    if ($allTransfers == null)
    {
    $emptymessage = "Nog geen transacties";
    }
   
  } else {
    header("Location: inloggen.php");
  }


  ?>

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

<?php if(isset($emptymessage)) :?>
        <h2 class="emptyMessage"><?php echo $emptymessage; ?></h2>
    <?php endif; ?>   

<div id="transactie_datum"><p>09-10-2010</p></div>

<div id="transactie_kader">

<?php foreach ($allTransfers as $allTranser) :?>
<div id="transactie_gegevens">

<p>Verzender: <?php echo $allTranser['user_verzender'];?></p>
<p>Ontvanger: <?php echo $allTranser['user_ontvanger'];?> </p>

<?php endforeach; ?>


<?php foreach ($getTransfer as $getTrans) :?>
<div id="transactie_bedrag">
<p> Tokens :<?php echo $getTrans['bedrag'];?> </p>
 </div>
 <?php endforeach; ?>

<div id="transactie_details">
<p>Meer details >> </p>
</div>



</div>


</div>





</section>


    
</body>
</html>