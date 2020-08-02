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


?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
				<div class="formfield">
				<p>Kies een gebruiker:</p>
				<span class="input_search_field">Search</span>
				<input type="text" name="search_text" id="search_text" placeholder="Zoek een gebruiker"></div>
				</div>
				<br>
				<div id="result"></div>
				
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


</body>



	<!-- 
  <script>

  $(document).ready(function(){
	  $('#search_text').keyup(function(){
		var txt = $(this).val();
		if(text != ''){

		}else{
			$('#result').html('');
			$.ajax({
				url:'/classes/Search.php',
				method:"post",
				data:{search:txt},
				dataType:"text",
				succes:function(data){
					$('#result').html(data);
				}
			});
		}
	  });
  })
  </script>

-->
</html>