<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (isset($data['id'])) {
    $ticketsFile = 'tickets.json';

    if (file_exists($ticketsFile)) {
        $currentData = json_decode(file_get_contents($ticketsFile), true);
        $updated = false;

        // Buscar y eliminar el ticket si su estado es "Resuelto"
        foreach ($currentData['tickets'] as $index => $ticket) {
            if ($ticket['id'] === $data['id']) {
                if ($ticket['estado'] === 'Resuelto') {
                    // Eliminar el ticket del array
                    unset($currentData['tickets'][$index]);
                    $currentData['tickets'] = array_values($currentData['tickets']); // Reindexar el array
                    $updated = true;
                }
                break;
            }
        }

        if ($updated) {
            if (file_put_contents($ticketsFile, json_encode($currentData, JSON_PRETTY_PRINT))) {
                echo json_encode(["mensaje" => "Ticket eliminado correctamente"]);
            } else {
                http_response_code(500);
                echo json_encode(["mensaje" => "Error al eliminar el ticket"]);
            }
        } else {
            http_response_code(404);
            echo json_encode(["mensaje" => "Ticket no encontrado o no está resuelto"]);
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
