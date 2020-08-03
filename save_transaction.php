<?php

include_once (__DIR__ "/./classes/Transaction.")

if (!empty($_POST)){

// new comment
$c = new Transfer();
$c->setBedrag($_POST['bedrag']);
$c->setDescription($_POST['description']);
$c->setUser_ontvanger($_POST['user_ontvanger']);
$c->setUser_verzender($_POST['user_verzender']); //*_SESSION

//save
$c->save();

// succes teruggeven
$reponse = [
    'status' => 'succes',
    'body' => htmlspecialchars($c->getText());
    'message' => 'Transaction saved';
];

header('Content-Type: application/json');
echo json_encode($response);
}