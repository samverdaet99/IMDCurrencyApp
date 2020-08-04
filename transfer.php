<?php
include_once (__DIR__ . "/classes/User.php");
include_once (__DIR__ . "/classes/Transaction.php");
include_once (__DIR__ . "/classes/Search.php");

session_start();
$boodschap = '';


//----- search username balk -----

// Search for name in db 
	if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]) {
    if (isset($_GET['searchName'])) {
        $searchField = $_GET['searchField'];
        $searchName = Search::searchName($searchField);

        if (empty($_GET['searchField'])) {
            $error = "Vul een naam in";
        } elseif (count($searchName) > 0) {
            foreach ($searchName as $name) {
                $boodschap .=  htmlspecialchars($name['username']) ;
            }
        } else {
            $error = "Geen resultaten";
        }
    }
	} 	else {
    //header("Location: inloggen.php");
}


//----- data bewaren in databank -----


if (!empty($_POST)) {
		
	try {
	  $transfer = new Transaction();
	  $transfer->setBedrag($_POST['bedrag']);
	  $transfer->setDescription($_POST['description']);

	  $transfer->makeTransfer();
	  $transfer->checkTokens();

	  session_start();

	  $_SESSION['transfer'] = $_POST['bedrag'];
	  header("Location: transfer.php");

	} catch (\Throwable $th) {
	  $error = $th->getMessage();
	}
  }

?>

	
 


<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>

<div id="logout">
<a href="logout.php">
Uitloggen</a>
</div>

<a href="index.php">Terug</a>



<section id="kader_groot_transfer">
<form action="" method="POST" id="form_transfer">


<div class="form-group">
                <label for="name"><b>Naam</b></label>
                <input class="form-control" type="text" name="searchField" placeholder="Naam" id="searchName" autocomplete="off">
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
			

</body>
</html>