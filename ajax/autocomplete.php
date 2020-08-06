
<?php

include_once(__DIR__ . "./classes/Search.php");

if (!empty($_POST)) {

    $input = $_POST['text'];

    $result = Search::autocompleteSearchName($input);

    $resp_body = $result ? [$result] : [];
    $response = [
        'status' => "succes",
        'body' => $resp_body
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
}