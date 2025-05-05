<?php
require 'db.php';

$sql = "SELECT id, asunto_actividad, convoca, participantes, hora_inicio, hora_fin, lugar, descripcion, enlace_virtual, creado_por FROM actividades";
$stmt = $conexion->query($sql);
$eventos = [];

while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $color = '#ffffff'; // Color por defecto
    $class = 'default'; // Clase por defecto

    // Asignar clases personalizadas según el usuario creador
    if ($fila['creado_por'] === 'admin') {
        $class = 'admin'; // clase nueva para color rojo
    } elseif ($fila['creado_por'] === 'consejo') {
        $class = 'consejo';
    } elseif ($fila['creado_por'] === 'drtc') {
        $class = 'drtc';
    }
    

    $eventos[] = [
        'id' => $fila['id'],
        'title' => $fila['asunto_actividad'],
        'start' => $fila['hora_inicio'],
        'end' => $fila['hora_fin'],
        'color' => $color,
        'className' => $class,
       
        'extendedProps' => [
            'convoca' => $fila['convoca'],
            'participantes' => $fila['participantes'],
            'lugar' => $fila['lugar'],
            'descripcion' => $fila['descripcion'],
            'enlace_virtual' => $fila['enlace_virtual'],
            'creado_por' => $fila['creado_por']
        ]
    ];
}

echo json_encode($eventos);
?>
