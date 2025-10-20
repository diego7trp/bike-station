<?php
$servidor = "localhost";
$usuario = "root";
$password = "";
$base_datos = "bike_station";

// Crear conexión
$conn = mysqli_connect($servidor, $usuario, $password, $base_datos);

// Verificar conexión
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Establecer charset
mysqli_set_charset($conn, "utf8");
?>