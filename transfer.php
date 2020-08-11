<?php
include_once (__DIR__ . "/classes/Transaction.php");
include_once (__DIR__ . "/classes/Search.php");
include_once (__DIR__ . "/classes/User.php");



session_start();
	


//------- search user


    if (isset($_GET['searchUser'])) {
        $searchField = trim($_GET['searchField'], " t.");
        $searchUser = Search::findUser($searchField);

        if (empty($searchField)) {
            $error = 'Vul een username in';
        } elseif (strlen($searchField) < 3) {
            $error = "Voer minstens 3 karakters in.";
        }

        if (strlen($searchField) > 2) {
            if (count($searchUser) > 0) {
                foreach ($searchUser as $searchusers) {
                    $succes = '<div>' . 'Gevonden user: '
                        . htmlspecialchars($searchusers['username']) . '</div>' ;
                }
            } else {
                $error = 'Geen users gevonden';
            }
        }
    
} else {
    //header("Location: login.php");
}


//------- transacties

	if (!empty($_POST)) {
		
	try {
	  $transfer = new Transaction();
	  $transfer->setBedrag($_POST['bedrag']);
	  $transfer->setDescription($_POST['description']);
	  $transfer->setDatum($_POST['datum']);
	$transfer->setUser_ontvanger($_POST['searchField']);



	  $transfer->saveTransfer();

	  $transaction = new Transaction();
	  $transaction->setBedrag($_POST['bedrag']);
	  Transaction::updateTokens($transaction);
	  Transaction::updateTokensOntvanger($transaction);

	 
		//$tokenschecken = Transaction::tokenscheck($transfer);
		//$bedragchekken = Transaction::bedragcheck($transfer);
		
		//var_dump($tokenschecken);

	  //if ($tokenschecken > $bedragchekken){
	//	echo "beschikbaar";
	 // } else{
		//  echo "niet beschikbaar";
		//}

	  

	  $_SESSION['transfer'] = $_POST['bedrag'];

	} 
	catch (\Throwable $th) {
	  $error = $th->getMessage();
	}
  }

?>
 


<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles/style.css">
	<script src="jquery/jquery.js"></script> 
    <title>Transfers</title>
</head>
<body>

<div id="terug"><a href="index.php">&#8592;</a></div>


<div id="paginatitel">
	<h1>Nieuwe transactie</h1>
	<p>Vul onderstaande velden in om een nieuwe transactie uit te voeren.</p>
</div>



<section id="kader_groot_transfer">			
				<br> 

        <?php if (isset($error)) : ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>

    </div>


<!--
	<form method="GET" action="">
            <div class="formfield">
                <label for="username">Naar welke gebruiker wil je een bedrag overschrijven? (Bv: 'Max') <br></label>
                <input class="formfield" type="text" name="searchField" placeholder="Zoek een gebruiker" id='searchUser' autocomplete="off">
                <div><a class="" id="autocompleteClass"></a></div>

				<?php if (isset($succes)) : ?>
            <p id="description"><?php echo $succes; ?></p>
        <?php endif; ?>


            </div>


        <div class="form-group">
                <input class="btn" type="submit" value="Zoek" name='searchUser'>
            </div>
			

			</form> 
-->
	

<form action="" method="POST" id="form_transfer">


            <div class="form-group">

        <?php if (isset($succes1)) : ?>
            <p>
                <?php echo $succes1; ?>
            </p>
        <?php endif; ?>
		</div>


			<div class="formfield">
                <label for="name">Naar:</label><br>
                <input class="form-control" type="text" name="searchField" placeholder="Naam" id="searchName" autocomplete="off">
                <div id="suggesstionBox"></div>
            </div>









				<br> 

				<div class="formfield">
					<label for="bedrag">Kies een bedrag:</label>
					<br>
					<input type="number" id="bedrag" name="bedrag">
				</div>
				<br>

				<div class="formfield">
					<label for="beschrijving">Beschrijving transfer:</label>
					<br>
					<input type="text" id="description" name="description">
				</div>
				<br>

				<div class="formfield">
					<label for="datum">Datum van uitvoering:</label>
					<br>
					<input type="date" id="datum" name="datum">
				</div>
				<br>

                <br>

				<div class="formfield_submit">
					<input type="submit" value="Plaats transfer" class="btn">	
				</div>

               
                
			</form>

			</section>


			 <script src="js/autocomplete.js"></script> 
			 <script src="jquery/jquery.js"></script> 
			 
			

</body>
</html>