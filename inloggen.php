<?php

include_once(__DIR__ . '/classes/User.php');


if(!empty($_POST)){ 

	$user = new User();
	$email = $_POST['email'];
    $password = $_POST['password'];
    
	//check if required field are not empty 
	if(!empty($email) && !empty($password)){

	//check  username
		if($user->canLogin($email,$password)){
			session_start();
			$_SESSION['user'] = $emaill;
			header("Location: index.php"); //redirect to index.php
        }

        else{
			$error = "Onjuist E-mail adres of wachtwoord";
		}
	} 
	else{
		$error ="E-mail en wachtwoord zijn verplicht";	
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


</div>
        
        <div id="form_inloggen">
			<form action="" method="post">
				
				<div class="formfield">
					<label for="Username">E-mailadres</label>
					<br>
					<input type="text" id="email" name="email">
				</div>
				<br>

			    <div class="formfield">
					<label for="Wachtwoord">Wachtwoord</label>
					<br>
					<input type="password" id="password" name="password">
				</div> 
                <br>

				<?php if (isset($error)) : ?>
				<div class="error" >
					<?php echo $error ?>
				</div>
				<?php endif; ?>
				<div class="formfield_submit">
					<input type="submit" value="inloggen" class="btn-inloggen">	
				</div>
 
                
			</form>
		 </div>
	</div>

    <div>
    <p>Ben je een nieuw member? klik <a href="register.php"> hier om te registreren</a></p>
    </div>

    
</body>
</html>