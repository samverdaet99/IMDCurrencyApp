<?php
include_once (__DIR__ . "/classes/User.php");
include_once (__DIR__ . "/classes/Transaction.php");
include_once (__DIR__ . "/classes/Search.php");


?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<div id="form_transfer">
			<form action="" method="post">



    
    <form action="transfer.php" method="POST">

    <div class="formfield">
    <label for="search">Selecteer een gebruiker:</label></br>
    <input type="text" name="search" placeholder="Searh for members">
    <input type="submit" value=">>">
    </div>

    </form>

    <?php
    print("$output")
    ;?>


				
				<div class="formfield">
					<label for="bedrag">Kies een bedrag:</label>
					<br>
					<input type="text" id="bedrag" name="bedrag">
				</div>
				<br>

				<div class="formfield">
					<label for="beschrijving">Beschrijving transfer:</label>
					<br>
					<input type="text" id="beschrijving" name="beschrijving">
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