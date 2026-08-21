<?php

require_once 'includes/conexion.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header("Location: index.php?msg=error");
    exit;
}


$sql_check = "SELECT id, apellido, nombre FROM alumnos WHERE id = $id";
$res = mysqli_query($conexion, $sql_check);

if (!$res || mysqli_num_rows($res) === 0) {
    header("Location: index.php?msg=error");
    exit;
}


$sql = "DELETE FROM alumnos WHERE id = $id";

if (mysqli_query($conexion, $sql)) {
    header("Location: index.php?msg=baja_ok");
} else {
    header("Location: index.php?msg=error");
}

mysqli_close($conexion);
exit;
?>