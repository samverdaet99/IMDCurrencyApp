<?php
include_once (__DIR__ . "/classes/Transaction.php");
include_once (__DIR__ . "/classes/Search.php");
include_once (__DIR__ . "/classes/User.php");




//----- data bewaren in databank -----
if (!empty($_POST)) {

		if (isset($_GET['searchName'])) {
			$searchField = $_GET['user_ontvanger'];
			  $searchName = Search::searchName($user_ontvanger);
	 
			  if (empty($_GET['user_ontvanger'])) {
				$error = "Vul een naam in";
			 } elseif (count($searchName) > 0) {
				foreach ($searchName as $user_ontvanger) {
					 $boodschap .=  htmlspecialchars($user_ontvanger['user_ontvanger']) ;
				  }
			  } else {
			   $error = "Geen resultaten";
			}
	   }
		 //} 	else {
			//header("Location:transfer.php");
	  //}
	 
		
	try {
	  $transfer = new Transaction();
	  $transfer->setBedrag($_POST['bedrag']);
	  $transfer->setDescription($_POST['description']);
	  $transfer->setDatum($_POST['datum']);
	  $transfer->setUser_ontvanger($_POST['user_ontvanger']);


	  $transfer->saveTransfer();
	  $transfer->checkTokens("tokens");
	  $transfer->vergelijk();
	  
	  session_start();
	  $_SESSION['transfer'] = $_POST['bedrag'];
	  //header("Location: transfer.php");
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
    <title>Document</title>
</head>
<body>

<a href="index.php">Terug</a>



<section id="kader_groot_transfer">
<form action="" method="POST" id="form_transfer">


		<div class="formfield">
				<label for="name">Selecteer een gebruiker om <br>tokens naar te verzenden:</label>
				<br>
                <input class="form-control" type="text" name="user_ontvanger" placeholder="Naam" id="searchName" autocomplete="off">
                <div id="suggesstionBox"></div>
            </div>


		
			
				<?php if (isset($boodschap)) : ?>
            	<p>
            	<?php echo $boodschap; ?>
            	</p>
       			<?php endif; ?>

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
					<label for="datum">Datum:</label>
					<br>
					<input type="date" id="datum" name="datum">
				</div>
				<br>





                <br>
				<?php if (isset($error)) : ?>
    			<div class="error" >
					<?php echo $error ?>
				</div>
				<?php endif; ?>

				<div class="formfield_submit">
					<input type="submit" value="Plaats transfer" class="btn">	
				</div>

               
                
			</form>


			</section>

			<div id="logout">
<a href="logout.php">
Uitloggen</a>
</div>


			 <script src="js/autocomplete.js"></script> 
			 <script src="jquery/jquery.js"></script> 
			

</body>
</html>