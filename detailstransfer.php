<?php
include_once (__DIR__ . "/classes/User.php");
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


//if(isset($_SESSION['transfer'])){
  //if (!empty($_POST)) {

   // $transfer = new Transaction();

    //$allTransfers = $transfer->getTransfers($_SESSION['transfer']);

    //if ($allTransfers == null)
    //{
    //$emptymessage = "Nog geen transacties";
    //}
   
  //} else {
    //header("Location: alletransacties.php");
  //}



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
$result = $transfer->showDetails($_GET['id']);


?>
</div>


 

</section>    


    
</body>
</html>