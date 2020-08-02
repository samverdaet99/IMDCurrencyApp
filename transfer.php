<?php
include_once (__DIR__ . "/classes/User.php");
include_once (__DIR__ . "/classes/Transaction.php");
//include_once (__DIR__ . "/classes/Search.php");

if (!empty($_POST)) {	
	try {

	  $transaction = new Transaction();
	  $transaction->setBedrag($_POST['bedrag']);
	  $transaction->setDescription($_POST['description']);
	  

	  $transaction->makeTransfer();

	  session_start();

	  $_SESSION['transaction'] = $_POST['bedrag'];
	  header("Location: index.php");
	} catch (\Throwable $th) {
	  $error = $th->getMessage();
	}
  }


?><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form>
<!--
				<div class="search-box">
				<label for="zoekbalk">Zoek een gebruiker:</label>
				<br>
        		<input type="text" id="zoekbalk" autocomplete="off" placeholder="Search country..." />
        		<div class="result"></div>
    			</div>
-->
				
				<br> 

				<div class="formfield">
					<label for="bedrag">Kies een bedrag:</label>
					<br>
					<input type="text" id="bedrag" name="bedrag">
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




		<!-- Zoekbalk 
					
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script type="text/javascript">

		$(document).ready(function(){
    	$('.search-box input[type="text"]').on("keyup input", function(){

        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("classes/Search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    	});
    
    		// Set search input value on click of result item
    		$(document).on("click", ".result p", function(){
        		$(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        		$(this).parent(".result").empty();
    	});
	});

</script>

-->

</body>
</html>