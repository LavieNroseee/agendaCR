<?php
require 'db.php';

$usuarios = [
    ['username' => 'admin', 'password' => 'admin123', 'rol' => 'admin', 'sede' => 'CR'],
    ['username' => 'consejo', 'password' => 'consejo123', 'rol' => 'normal', 'sede' => 'CR'],
    ['username' => 'drtc', 'password' => 'drtc123', 'rol' => 'normal', 'sede' => 'DRTC'],
];

foreach ($usuarios as $usuario) {
    // Hasheando la contraseña
    $hashed_password = password_hash($usuario['password'], PASSWORD_DEFAULT);

    // Preparar el SQL
    $sql = "INSERT INTO usuarios (username, password, rol, sede) VALUES (:username, :password, :rol, :sede)";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':username', $usuario['username']);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->bindParam(':rol', $usuario['rol']);
    $stmt->bindParam(':sede', $usuario['sede']);

    // Ejecutar la inserción
    $stmt->execute();
}

echo "Usuarios insertados correctamente";
?>
