<?php

require_once 'includes/conexion.php';

$titulo = "Cursos";
$errores = [];
$mensaje = "";
$tipo_mensaje = "";

$datos = [
    'nombre'   => '',
    'anio'     => '',
    'division' => '',
    'turno'    => 'Mañana'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos['nombre']   = trim($_POST['nombre'] ?? '');
    $datos['anio']     = trim($_POST['anio'] ?? '');
    $datos['division'] = trim($_POST['division'] ?? '');
    $datos['turno']    = $_POST['turno'] ?? 'Mañana';

    if ($datos['nombre'] === '') {
        $errores[] = "El nombre del curso es obligatorio.";
    }
    if ($datos['anio'] === '') {
        $errores[] = "El año es obligatorio.";
    } elseif (!is_numeric($datos['anio']) || $datos['anio'] < 1 || $datos['anio'] > 7) {
        $errores[] = "El año debe ser un número entre 1 y 7.";
    }
    if ($datos['division'] === '') {
        $errores[] = "La división es obligatoria.";
    }

    if (empty($errores)) {
        $nombre_esc   = mysqli_real_escape_string($conexion, $datos['nombre']);
        $anio_esc     = (int)$datos['anio'];
        $division_esc = mysqli_real_escape_string($conexion, $datos['division']);
        $turno_esc    = mysqli_real_escape_string($conexion, $datos['turno']);

        $sql = "INSERT INTO cursos (nombre, anio, division, turno)
                VALUES ('$nombre_esc', $anio_esc, '$division_esc', '$turno_esc')";

        if (mysqli_query($conexion, $sql)) {
            $mensaje = "Curso registrado correctamente.";
            $tipo_mensaje = "exito";
            $datos = ['nombre' => '', 'anio' => '', 'division' => '', 'turno' => 'Mañana'];
        } else {
            $errores[] = "Error al guardar: " . mysqli_error($conexion);
        }
    }
}

$sql = "SELECT c.id, c.nombre, c.anio, c.division, c.turno,
               COUNT(a.id) AS cantidad_alumnos
        FROM cursos c
        LEFT JOIN alumnos a ON c.id = a.curso_id
        GROUP BY c.id
        ORDER BY c.anio DESC, c.division ASC";

$resultado = mysqli_query($conexion, $sql);

include 'includes/header.php';
?>

<h1 class="titulo-pagina">Cursos</h1>

<?php if ($mensaje): ?>
    <div class="mensaje mensaje-<?php echo $tipo_mensaje; ?>">
        <?php echo htmlspecialchars($mensaje); ?>
    </div>
<?php endif; ?>

<?php if (!empty($errores)): ?>
    <div class="mensaje mensaje-error">
        <ul style="margin-left: 1.2rem;">
            <?php foreach ($errores as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div style="display: grid; grid-template-columns: 1fr; gap: 2rem;">
    
    <div>
        <h2 style="margin-bottom: 1rem; color: var(--color-primario);">Agregar Curso</h2>
        <form method="POST" action="cursos.php" class="formulario" novalidate>
            <div class="grupo-form">
                <label for="nombre" class="requerido">Nombre del curso</label>
                <input type="text" id="nombre" name="nombre" 
                       value="<?php echo htmlspecialchars($datos['nombre']); ?>" 
                       required maxlength="80" placeholder="Ej: Sexto Año Informática">
            </div>

            <div class="grupo-form">
                <label for="anio" class="requerido">Año</label>
                <input type="number" id="anio" name="anio" 
                       value="<?php echo htmlspecialchars($datos['anio']); ?>" 
                       required min="1" max="7" placeholder="Ej: 6">
            </div>

            <div class="grupo-form">
                <label for="division" class="requerido">División</label>
                <input type="text" id="division" name="division" 
                       value="<?php echo htmlspecialchars($datos['division']); ?>" 
                       required maxlength="10" placeholder="Ej: A, B, C...">
            </div>

            <div class="grupo-form">
                <label for="turno" class="requerido">Turno</label>
                <select id="turno" name="turno" required>
                    <option value="Mañana" <?php echo ($datos['turno'] == 'Mañana') ? 'selected' : ''; ?>>Mañana</option>
                    <option value="Tarde"  <?php echo ($datos['turno'] == 'Tarde')  ? 'selected' : ''; ?>>Tarde</option>
                    <option value="Noche"  <?php echo ($datos['turno'] == 'Noche')  ? 'selected' : ''; ?>>Noche</option>
                </select>
            </div>

            <div class="botones-form">
                <button type="submit" class="btn btn-exito">Guardar curso</button>
            </div>
        </form>
    </div>

    <div>
        <h2 style="margin-bottom: 1rem; color: var(--color-primario);">Listado de Cursos</h2>
        <div class="tabla-contenedor">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Curso</th>
                        <th>Año</th>
                        <th>División</th>
                        <th>Turno</th>
                        <th>Alumnos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($resultado && mysqli_num_rows($resultado) > 0): ?>
                        <?php while ($curso = mysqli_fetch_assoc($resultado)): ?>
                            <tr>
                                <td><?php echo $curso['id']; ?></td>
                                <td><strong><?php echo htmlspecialchars($curso['nombre']); ?></strong></td>
                                <td><?php echo $curso['anio']; ?>°</td>
                                <td><?php echo htmlspecialchars($curso['division']); ?></td>
                                <td><?php echo htmlspecialchars($curso['turno']); ?></td>
                                <td><?php echo $curso['cantidad_alumnos']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align:center;">No hay cursos registrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
mysqli_close($conexion);
include 'includes/footer.php';
?>