<?php
include_once (__DIR__ . "/classes/Transaction.php");
include_once (__DIR__ . "/classes/Search.php");
include_once (__DIR__ . "/classes/User.php");





//----- data bewaren in databank -----
//if (!empty($_POST)) {

		//$user = new User();
		//session_start();

		//$succes1 = '';	

	
	  if (isset($_GET['searchName'])) {
		$searchField = $_GET['searchField'];
		$searchName = Search::searchName($searchField);
	
		if (empty($_GET['searchField'])) {
			$error = "Vul een naam in";
		} elseif (count($searchName) > 0) {
			foreach ($searchName as $name) {
				$succes1 .=  htmlspecialchars($name['username'])  . '</div>' . '</a>';
			}
		} else {
			$error = "Geen resultaten";
		}
	}

//}
	//else {
	//header("Location: zoekbalk.php");
	//}


	if (!empty($_POST)) {
		
	try {
	  $transfer = new Transaction();
	  $transfer->setBedrag($_POST['bedrag']);
	  $transfer->setDescription($_POST['description']);
	  $transfer->setDatum($_POST['datum']);




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

<div id="terug"><a href="index.php">&#8592;</a></div>


<div id="paginatitel">
	<h1>Nieuwe transactie</h1>
	<p>Vul onderstaande velden in om een nieuwe transactie uit te voeren.</p>
</div>

<section id="kader_groot_transfer">
<form action="" method="POST" id="form_transfer">



			<div class="form-group">
                <label for="name"><b>Naam</b></label>
                <input class="form-control" type="text" name="searchField" placeholder="Naam" id="searchName" autocomplete="off">
                <div id="suggesstionBox"></div>
            </div>



            <div class="form-group">

        <?php if (isset($succes1)) : ?>
            <p>
                <?php echo $succes1; ?>
            </p>
        <?php endif; ?>
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


			 <script src="js/autocomplete.js"></script> 
			 <script src="jquery/jquery.js"></script> 
			 
			

</body>
</html>