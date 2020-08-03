<?php
include_once (__DIR__ . "/classes/User.php");
include_once (__DIR__ . "/classes/Transaction.php");
include_once (__DIR__ . "/classes/Search.php");

$boodschap = '';

//----- search username balk -----


if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]) {
    if (isset($_GET['searchUser'])) {
        $searchField = $_GET['searchField'];
		$searchUser = Search::searchUser($searchField);
		
		

        if (empty($_GET['searchField'])) {
            $error = "Vul een naam in";
        } elseif (count($searchUser) > 0) {
            foreach ($searchUser as $username) {
                $boodschap .= '<a>' . htmlspecialchars($username['username']) . '" >' . '<div>'  . '</a>';
            }
        } else {
            $error = "Geen resultaten";
        }
    } else{
		header("Location: login.php");
	}
}



//----------------- tokens checken -----------------------------
if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]) {
	if (isset($_GET['checkTokens'])) {
	try {

	  $transfers = new Transfers();
	  $transfers->setTokens($_POST['tokens']);
	  

	  $transfers->checkTokens();

	  session_start();

	  $_SESSION['transfers'] = $_POST['bedrag'];
	  header("Location: index.php");
	} catch (\Throwable $th) {
	  $error = $th->getMessage();
	}


}
}
	
  ?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="" method="post">

				<div class="search-box">
				<label for="zoekbalk">Zoek een gebruiker:</label>
				<br>
        		<input type="text" id="searchUser" name="searchField" autocomplete="off" placeholder="Zoek een gebruiker" />
        		<div class="result"></div>
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

            </div>







</body>
</html>