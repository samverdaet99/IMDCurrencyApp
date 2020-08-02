
include_once (__DIR__ . "/Db.php");

<?php

$conn = Db::getConnection();

$searchq = $_POST['search'];
$searchq = preg_replace("#0-9a-z#i","",$searchq);

//$query = mysql_query("SELECT * FROM members WHERE username LIKE '%$searchq%'") or die("could not seacrh");
$query = $conn->prepare("SELECT * FROM users WHERE username LIKE '%$searchq%'") or die("could not seacrh");



$output = '';
//$searchq = $_POST['search'];
//$sql = "SELECT * FROM users WHERE username LIKE '%$searchq%'";

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0){
    $output .= '<h4>Gebruiker</h4>';


while ($row = mysqli_fetch_array($result)){
    $output .= '<p>' .$row["username"].'<p>';
     
}
echo $output;
}
else{
    echo 'Gebruiker niet teruggevonden';
}



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


   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">

$(document).ready(function(){
    $('#search_text').keyup(function(){
      var txt = $(this).val();
      if(text != ''){

      } else{
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






-------------------------------------
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
if(isset($_REQUEST["term"])){
    // Prepare a select statement
    $sql = "SELECT * FROM users WHERE username LIKE ?";
    global $link;
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_term);
        
        // Set parameters
        $param_term = $_REQUEST["term"] . '%';
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    echo "<p>" . $row["name"] . "</p>";
                }
            } else{
                echo "<p>Geen matches gevonden</p>";
            }
        } else{
            echo "ERROR: er ging iets fout $sql. " . mysqli_error($link);
        }
    }
     

}