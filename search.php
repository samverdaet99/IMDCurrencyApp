<?php

include_once (__DIR__ . "/classes/Search.php");


?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="search.php" method="POST">
    
    <input type="text" name="search" placeholder="Searh for members">
    <input type="submit" value=">>">
    </form>

    <?php
    print("$output")
    ;?>


</body>
</html>