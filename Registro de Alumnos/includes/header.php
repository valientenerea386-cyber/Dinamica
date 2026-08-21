<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($titulo) ? $titulo . ' - ' : ''; ?>Registro de Alumnos</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header>
        <div class="header-contenido">
            <div class="logo">
                <span>🎓</span> Registro de Alumnos
            </div>
            <nav>
                <ul>
                    <li><a href="index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'activo' : ''; ?>">Inicio / Listado</a></li>
                    <li><a href="alta.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'alta.php' ? 'activo' : ''; ?>">Agregar Alumno</a></li>
                    <li><a href="cursos.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'cursos.php' ? 'activo' : ''; ?>">Cursos</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>