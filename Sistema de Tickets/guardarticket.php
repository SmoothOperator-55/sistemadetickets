<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


$input = file_get_contents('php://input');
$data = json_decode($input, true);

if(isset($data['area']) && isset($data['solicitante']) && isset($data['tipoFalla']) && isset($data['descripcion'])) {

    $nuevoTicket = [
        "id" => uniqid(),
        "area" => htmlspecialchars($data['area']),
        "solicitante" => htmlspecialchars($data['solicitante']),
        "tipoFalla" => htmlspecialchars($data['tipoFalla']),
        "descripcion" => htmlspecialchars($data['descripcion']),
        "estado" => "Pendiente"
    ];

    $ticketsFile = 'tickets.json';
    if(file_exists($ticketsFile)) {
        $currentData = json_decode(file_get_contents($ticketsFile), true);
    } else {
        $currentData = ["tickets" => []];
    }

    $currentData['tickets'][] = $nuevoTicket;

    if(file_put_contents($ticketsFile, json_encode($currentData, JSON_PRETTY_PRINT))) {
        echo json_encode(["mensaje" => "Ticket guardado correctamente"]);
    } else {
        http_response_code(500);
        echo json_encode(["mensaje" => "Error al guardar el ticket"]);
    }
} else {
    http_response_code(400);
    echo json_encode(["mensaje" => "Datos incompletos"]);
}
?>
