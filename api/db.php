<?php
$host = "localhost"; //"localhost"
$db = "agendacr"; //"agendacr";
$user = "root"; //agenda_user;
$pass = ""; //"12345678"

try {
    $conexion = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
