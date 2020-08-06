<?php

include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Search.php");

$user = new User();
session_start();

$succes1 = '';




  if (isset($_GET['searchName'])) {
    $searchField = $_GET['searchField'];
    $searchName = Search::searchName($searchField);

    if (empty($_GET['searchField'])) {
        $error = "Vul een naam in";
    } elseif (count($searchName) > 0) {
        foreach ($searchName as $name) {
            $succes1 .=  htmlspecialchars($name['username'])  . '</div>' . '</a>';
        }
    } else {
        $error = "Geen resultaten";
    }
}
//else {
//header("Location: zoekbalk.php");
//}

?>


<html>

<head>
<title>Search</title>
</head>

<body>

<div class="form-group">
                <label for="name"><b>Naam</b></label>
                <input class="form-control" type="text" name="searchField" placeholder="Naam" id="searchName" autocomplete="off">
                <div id="suggesstionBox"></div>
            </div>



            <div class="form-group">
        <?php if (isset($error)) : ?>
            <p>
                <?php echo $error; ?>
            </p>
        <?php endif; ?>

        <?php if (isset($succes1)) : ?>
            <p>
                <?php echo $succes1; ?>
            </p>
        <?php endif; ?>
    </div>

</body>

<script src="js/autocomplete.js"></script>

</html>