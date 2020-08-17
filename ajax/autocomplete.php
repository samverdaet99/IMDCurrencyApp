
<?php
include_once(__DIR__ . "/../classes/Db.php");
include_once(__DIR__ . "./../classes/Search.php");



if (!empty($_POST)){
    
    $searchUser = $_POST['text'];

    $result = Search::autocompleteTest($searchUser);

    $resp_body = $result ? [$result] : [];
    $response = [
        'status' => "succes",
        'body' => $resp_body
    ];

    header('Content-Type: application/json');
    echo json_encode($response);

}