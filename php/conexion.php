<?php
$servidor = "localhost";
$usuario = "root";
$password = "";
$base_datos = "bike_station";

$conn = mysqli_connect($servidor, $usuario, $password, $base_datos);

if (!$conn) {
    die(json_encode(['success' => false, 'message' => 'Error de conexión: ' . mysqli_connect_error()]));
}

mysqli_set_charset($conn, "utf8");
?>