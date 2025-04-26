<?php
require 'db.php';

$sql = "SELECT id, asunto_actividad, convoca, participantes, hora, lugar, descripcion, enlace_virtual FROM actividades";
$stmt = $conexion->query($sql);
$eventos = [];

// Función para generar un color aleatorio
function generarColorAleatorio() {
    $colores = ['#FFB6C1', '#87CEFA', '#90EE90', '#FFD700', '#FFA07A', '#DDA0DD', '#00CED1'];
    return $colores[array_rand($colores)];
}

while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $eventos[] = [
        'id' => $fila['id'],
        'title' => $fila['asunto_actividad'],
        'start' => $fila['hora'],
        
        'color' => generarColorAleatorio(), // 🎨 Color aleatorio
        'extendedProps' => [
            'convoca' => $fila['convoca'],
            'participantes' => $fila['participantes'],
            'lugar' => $fila['lugar'],
            'descripcion' => $fila['descripcion'],
            'enlace_virtual' => $fila['enlace_virtual']
        ]
    ];
}

echo json_encode($eventos);
?>
