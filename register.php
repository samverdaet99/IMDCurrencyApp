<?php

include_once (__DIR__ . "/classes/User.php");

if (!empty($_POST)) {	
	try {
	  $user = new User();
	  $user->setUsername($_POST['username']);
	  $user->setEmail($_POST['email']);
	  $user->setPassword($_POST['wachtwoord']);
	  $user->setConfirmPassword($_POST['wachtwoordHerhaling']);
	  $user->registerUser();
	  session_start();
	  $_SESSION['user'] = $_POST['email'];
	  header("Location: index.php");
	} catch (\Throwable $th) {
	  $error = $th->getMessage();
	}
  }

?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>
</head>
<body>

<div class="aanmelden">
      
        
        
        <div id="form_aanmelden">
			<form action="" method="post">
				
				<div class="formfield">
					<label for="username">Kies een username:</label>
					<br>
					<input type="text" id="username" name="username">
				</div>
				<br>

				<div class="formfield">
					<label for="email">Emailadres:</label>
					<br>
					<input type="text" id="email" name="email">
				</div>
                <br>

			    <div class="formfield">
					<label for="wachtwoord">Kies je wachtwoord:</label>
					<br>
					<input type="password" id="wachtwoord" name="wachtwoord">
				</div> 
                <br>
                
				<div class="formfield">
					<label for="wachtwoord_herhaling">Herhaal wachtwoord:</label>
					<br>
					<input type="password" id="wachtwoordHerhaling" name="wachtwoordHerhaling">
				</div>
                <br>
				<?php if (isset($error)) : ?>
    			<div class="error" >
					<?php echo $error ?>
				</div>
				<?php endif; ?>
				<div class="formfield_submit">
					<input type="submit" value="registreren" class="btn-aanmelden">	
				</div>

               
                
			</form>
		 </div>
	</div>
    
</body>
</html>