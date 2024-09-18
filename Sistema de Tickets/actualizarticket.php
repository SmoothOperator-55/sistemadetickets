<?php
// actualizarTicket.php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Obtener los datos enviados en el cuerpo de la solicitud
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Verificar que los datos necesarios están presentes
if(isset($data['id']) && isset($data['estado'])) {
    $ticketsFile = 'tickets.json';

    if(file_exists($ticketsFile)) {
        $currentData = json_decode(file_get_contents($ticketsFile), true);
        $updated = false;

        // Buscar y actualizar el ticket
        foreach($currentData['tickets'] as &$ticket) {
            if($ticket['id'] === $data['id']) {
                $ticket['estado'] = htmlspecialchars($data['estado']);
                $updated = true;
                break;
            }
        }

        if($updated) {
            if(file_put_contents($ticketsFile, json_encode($currentData, JSON_PRETTY_PRINT))) {
                echo json_encode(["mensaje" => "Estado actualizado correctamente"]);
            } else {
                http_response_code(500);
                echo json_encode(["mensaje" => "Error al actualizar el estado"]);
            }
        } else {
            http_response_code(404);
            echo json_encode(["mensaje" => "Ticket no encontrado"]);
        }
    } else {
        http_response_code(404);
        echo json_encode(["mensaje" => "Archivo de tickets no encontrado"]);
    }
} else {
    http_response_code(400);
    echo json_encode(["mensaje" => "Datos incompletos"]);
}
?>
