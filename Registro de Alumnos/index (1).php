<?php

require_once 'includes/conexion.php';

$titulo = "Listado de Alumnos";

$mensaje = "";
$tipo_mensaje = "";

if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case 'alta.php':
            $mensaje = "Alumno registrado correctamente.";
            $tipo_mensaje = "exito";
            break;
        case 'mod_ok':
            $mensaje = "Alumno modificado correctamente.";
            $tipo_mensaje = "exito";
            break;
        case 'baja_ok':
            $mensaje = "Alumno eliminado correctamente.";
            $tipo_mensaje = "exito";
            break;
        case 'error':
            $mensaje = "Ocurrió un error al procesar la solicitud.";
            $tipo_mensaje = "error";
            break;
    }
}




$sql = "SELECT a.id, a.apellido, a.nombre, a.dni, a.email, a.telefono, a.activo,
               c.nombre AS curso, c.anio, c.division, c.turno
        FROM alumnos a
        INNER JOIN cursos c ON a.curso_id = c.id
        ORDER BY a.apellido ASC, a.nombre ASC";

$resultado = mysqli_query($conexion, $sql);

$total_alumnos = 0;
$activos = 0;
$inactivos = 0;

if ($resultado) {
    $total_alumnos = mysqli_num_rows($resultado);
    while ($fila = mysqli_fetch_assoc($resultado)) {
        if ($fila['activo'] == 1) {
            $activos++;
        } else {
            $inactivos++;
        }
    }
    mysqli_data_seek($resultado, 0);
}

include 'includes/header.php';
?>

<h1 class="titulo-pagina">Listado de Alumnos</h1>

<?php if ($mensaje): ?>
    <div class="mensaje mensaje-<?php echo $tipo_mensaje; ?>">
        <?php echo htmlspecialchars($mensaje); ?>
    </div>
<?php endif; ?>

<div class="cards">
    <div class="card">
        <div class="numero"><?php echo $total_alumnos; ?></div>
        <div class="etiqueta">Total de alumnos</div>
    </div>
    <div class="card">
        <div class="numero"><?php echo $activos; ?></div>
        <div class="etiqueta">Activos</div>
    </div>
    <div class="card">
        <div class="numero"><?php echo $inactivos; ?></div>
        <div class="etiqueta">Inactivos</div>
    </div>
</div>

<div style="margin-bottom: 1rem;">
    <a href="c:\xampp\htdocs\Registro de Alumnos\alta.php" class="btn btn-exito">+ Agregar nuevo alumno</a>
</div>

<div class="tabla-contenedor">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Apellido y Nombre</th>
                <th>DNI</th>
                <th>Curso</th>
                <th>Turno</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($resultado && mysqli_num_rows($resultado) > 0): ?>
                <?php while ($alumno = mysqli_fetch_assoc($resultado)): ?>
                    <tr>
                        <td><?php echo $alumno['id']; ?></td>
                        <td>
                            <strong><?php echo htmlspecialchars($alumno['apellido'] . ', ' . $alumno['nombre']); ?></strong>
                        </td>
                        <td><?php echo htmlspecialchars($alumno['dni']); ?></td>
                        <td>
                            <?php echo htmlspecialchars($alumno['curso'] . ' ' . $alumno['division']); ?>
                            <br><small style="color:#718096;"><?php echo $alumno['anio']; ?>° año</small>
                        </td>
                        <td><?php echo htmlspecialchars($alumno['turno']); ?></td>
                        <td>
                            <?php if ($alumno['activo'] == 1): ?>
                                <span class="badge badge-activo">Activo</span>
                            <?php else: ?>
                                <span class="badge badge-inactivo">Inactivo</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="acciones">
                                <a href="c:\xampp\htdocs\Registro de Alumnos\modificar.phpid=<?php echo $alumno['id']; ?>" class="btn btn-primario btn-sm">Editar</a>
                                <a href="c:\xampp\htdocs\Registro de Alumnos\baja.phpid=<?php echo $alumno['id']; ?>" 
                                   class="btn btn-peligro btn-sm"
                                   onclick="return confirm('¿Está seguro de eliminar al alumno «<?php echo htmlspecialchars(addslashes($alumno['apellido'] . ', ' . $alumno['nombre'])); ?>»?');">
                                    Eliminar
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" style="text-align:center; padding: 2rem;">
                        No hay alumnos registrados. <a href="alta.php">Agregar el primero</a>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php
mysqli_close($conexion);
include 'includes/footer.php';
?>
