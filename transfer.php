<?php
include_once (__DIR__ . "/classes/User.php");
include_once (__DIR__ . "/classes/Transfer.php");

?>




<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer</title>
</head>
<body>

<form method="GET" action="">
        <div>
            <p>Zoek een gebruiker</p>

            <div class="form">
                <label for="name"><b>Naam</b></label>
                <input class="form-control" type="text" name="searchField" placeholder="Naam" id="searchName" autocomplete="off">
                <div id="zoekbalk"></div>
            </div>

            <div class="form">
                <input class="btn border search-name-btn" type="submit" value="Naam zoeken" name='searchName'>
            </div>
    </form>

    
</body>
</html>