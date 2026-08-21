<?php
$host      = "localhost";
$usuario   = "root";
$clave     = "";          
$basedatos = "registro_alumnos";

$conexion = mysqli_connect($host, $usuario, $clave, $basedatos);
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
mysqli_set_charset($conexion, "utf8mb4");
?>