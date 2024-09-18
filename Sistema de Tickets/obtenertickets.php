<?php
// obtenerTickets.php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$ticketsFile = 'tickets.json';

if(file_exists($ticketsFile)) {
    $currentData = json_decode(file_get_contents($ticketsFile), true);
    echo json_encode($currentData);
} else {
    echo json_encode(["tickets" => []]);
}
?>
