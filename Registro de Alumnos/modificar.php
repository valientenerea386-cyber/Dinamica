<?php

require_once 'includes/conexion.php';

$titulo = "Modificar Alumno";
$errores = [];
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header("Location: index.php?msg=error");
    exit;
}

$sql_alumno = "SELECT * FROM alumnos WHERE id = $id";
$res_alumno = mysqli_query($conexion, $sql_alumno);

if (!$res_alumno || mysqli_num_rows($res_alumno) === 0) {
    header("Location: index.php?msg=error");
    exit;
}

$alumno = mysqli_fetch_assoc($res_alumno);

$datos = [
    'apellido'         => $alumno['apellido'],
    'nombre'           => $alumno['nombre'],
    'dni'              => $alumno['dni'],
    'email'            => $alumno['email'],
    'fecha_nacimiento' => $alumno['fecha_nacimiento'],
    'telefono'         => $alumno['telefono'],
    'activo'           => $alumno['activo'],
    'curso_id'         => $alumno['curso_id']
];

$sql_cursos = "SELECT id, nombre, anio, division, turno FROM cursos ORDER BY anio DESC, division ASC";
$res_cursos = mysqli_query($conexion, $sql_cursos);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos['apellido']         = trim($_POST['apellido'] ?? '');
    $datos['nombre']           = trim($_POST['nombre'] ?? '');
    $datos['dni']              = trim($_POST['dni'] ?? '');
    $datos['email']            = trim($_POST['email'] ?? '');
    $datos['fecha_nacimiento'] = trim($_POST['fecha_nacimiento'] ?? '');
    $datos['telefono']         = trim($_POST['telefono'] ?? '');
    $datos['activo']           = $_POST['activo'] ?? '1';
    $datos['curso_id']         = $_POST['curso_id'] ?? '';

    if ($datos['apellido'] === '') {
        $errores[] = "El apellido es obligatorio.";
    }
    if ($datos['nombre'] === '') {
        $errores[] = "El nombre es obligatorio.";
    }
    if ($datos['dni'] === '') {
        $errores[] = "El DNI es obligatorio.";
    } elseif (!preg_match('/^[0-9]{7,10}$/', $datos['dni'])) {
        $errores[] = "El DNI debe contener solo números (7 a 10 dígitos).";
    }
    if ($datos['curso_id'] === '' || $datos['curso_id'] === '0') {
        $errores[] = "Debe seleccionar un curso.";
    }
    if ($datos['email'] !== '' && !filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El email no tiene un formato válido.";
    }

    if (empty($errores) && $datos['dni'] !== '') {
        $dni_check = mysqli_real_escape_string($conexion, $datos['dni']);
        $sql_dni = "SELECT id FROM alumnos WHERE dni = '$dni_check' AND id != $id";
        $res_dni = mysqli_query($conexion, $sql_dni);
        if ($res_dni && mysqli_num_rows($res_dni) > 0) {
            $errores[] = "Ya existe otro alumno registrado con ese DNI.";
        }
    }

    if (empty($errores)) {
        $apellido_esc = mysqli_real_escape_string($conexion, $datos['apellido']);
        $nombre_esc   = mysqli_real_escape_string($conexion, $datos['nombre']);
        $dni_esc      = mysqli_real_escape_string($conexion, $datos['dni']);
        $email_esc    = mysqli_real_escape_string($conexion, $datos['email']);
        $tel_esc      = mysqli_real_escape_string($conexion, $datos['telefono']);
        $activo_esc   = (int)$datos['activo'];
        $curso_esc    = (int)$datos['curso_id'];

        $fecha_sql = "NULL";
        if ($datos['fecha_nacimiento'] !== '') {
            $fecha_sql = "'" . mysqli_real_escape_string($conexion, $datos['fecha_nacimiento']) . "'";
        }

        $sql = "UPDATE alumnos SET 
                    apellido = '$apellido_esc',
                    nombre = '$nombre_esc',
                    dni = '$dni_esc',
                    email = '$email_esc',
                    fecha_nacimiento = $fecha_sql,
                    telefono = '$tel_esc',
                    activo = $activo_esc,
                    curso_id = $curso_esc
                WHERE id = $id";

        if (mysqli_query($conexion, $sql)) {
            header("Location: index.php?msg=mod_ok");
            exit;
        } else {
            $errores[] = "Error al actualizar: " . mysqli_error($conexion);
        }
    }
}

include 'includes/header.php';
?>

<h1 class="titulo-pagina">Modificar Alumno</h1>

<?php if (!empty($errores)): ?>
    <div class="mensaje mensaje-error">
        <ul style="margin-left: 1.2rem;">
            <?php foreach ($errores as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="modificar.php?id=<?php echo $id; ?>" class="formulario" novalidate>
    <div class="grupo-form">
        <label for="apellido" class="requerido">Apellido</label>
        <input type="text" id="apellido" name="apellido" 
               value="<?php echo htmlspecialchars($datos['apellido']); ?>" 
               required maxlength="80">
    </div>

    <div class="grupo-form">
        <label for="nombre" class="requerido">Nombre</label>
        <input type="text" id="nombre" name="nombre" 
               value="<?php echo htmlspecialchars($datos['nombre']); ?>" 
               required maxlength="80">
    </div>

    <div class="grupo-form">
        <label for="dni" class="requerido">DNI</label>
        <input type="text" id="dni" name="dni" 
               value="<?php echo htmlspecialchars($datos['dni']); ?>" 
               required maxlength="15">
    </div>

    <div class="grupo-form">
        <label for="curso_id" class="requerido">Curso</label>
        <select id="curso_id" name="curso_id" required>
            <option value="">-- Seleccione un curso --</option>
            <?php if ($res_cursos): ?>
                <?php while ($curso = mysqli_fetch_assoc($res_cursos)): ?>
                    <option value="<?php echo $curso['id']; ?>"
                        <?php echo ($datos['curso_id'] == $curso['id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($curso['nombre'] . ' ' . $curso['division'] . ' (' . $curso['turno'] . ')'); ?>
                    </option>
                <?php endwhile; ?>
            <?php endif; ?>
        </select>
    </div>

    <div class="grupo-form">
        <label for="email">Email (opcional)</label>
        <input type="email" id="email" name="email" 
               value="<?php echo htmlspecialchars($datos['email']); ?>" 
               maxlength="120">
    </div>

    <div class="grupo-form">
        <label for="fecha_nacimiento">Fecha de nacimiento (opcional)</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" 
               value="<?php echo htmlspecialchars($datos['fecha_nacimiento'] ?? ''); ?>">
    </div>

    <div class="grupo-form">
        <label for="telefono">Teléfono (opcional)</label>
        <input type="text" id="telefono" name="telefono" 
               value="<?php echo htmlspecialchars($datos['telefono'] ?? ''); ?>" 
               maxlength="30">
    </div>

    <div class="grupo-form">
        <label for="activo" class="requerido">Estado</label>
        <select id="activo" name="activo" required>
            <option value="1" <?php echo ($datos['activo'] == 1) ? 'selected' : ''; ?>>Activo</option>
            <option value="0" <?php echo ($datos['activo'] == 0) ? 'selected' : ''; ?>>Inactivo</option>
        </select>
    </div>

    <div class="botones-form">
        <button type="submit" class="btn btn-primario">Guardar cambios</button>
        <a href="index.php" class="btn btn-secundario">Cancelar</a>
    </div>
</form>

<?php
mysqli_close($conexion);
include 'includes/footer.php';
?>