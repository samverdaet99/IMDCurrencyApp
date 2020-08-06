<?php

include_once(__DIR__ . "/classes/User.php");

$user = new User();
session_start();


if (!empty($_POST['user'])) {
  $namesearch = htmlspecialchars($_POST['username']);
  $results = $user->searchpeop($username);
}

?>


<html>

<head>
<title>Search</title>
</head>

<body>

<h2>Search</h2>

<h1> Filter op naam </h1>
      <br>
      <form action="" method="post">
        <div class="form-group">
          <label for="namesearch" class=""> Search name </label>
          <input type="text" name="username" id="username" placeholder="name">
        </div> <br>
        <div class="form btn">
          <input type="submit" class="btn btn-primary" name="name" value="searchname">
        </div>
      </form>


         <p> <b> Results: </b> </p>
            <?php if (isset($results)) : ?>
           <?php foreach ($results as $result) : ?>
            <p><?php echo $result['username'];  ?> </p>  
          <?php endforeach; ?>
           <?php endif; ?> 

</body>

</html>