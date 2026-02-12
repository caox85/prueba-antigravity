<?php
require_once 'includes/auth.php';
requireLogin();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $enrollment_id = trim($_POST['enrollment_id']);
    $grade_group = trim($_POST['grade_group']);

    if (empty($first_name) || empty($last_name) || empty($enrollment_id)) {
        $error = "Nombre, Apellido y Matrícula son obligatorios.";
    } else {
        $db = Database::getInstance();
        try {
            $stmt = $db->prepare("INSERT INTO students (first_name, last_name, enrollment_id, grade_group) VALUES (:fn, :ln, :en, :gg)");
            $stmt->execute([
                ':fn' => $first_name,
                ':ln' => $last_name,
                ':en' => $enrollment_id,
                ':gg' => $grade_group
            ]);
            $success = "Alumno registrado correctamente.";
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // Duplicate entry
                $error = "La matrícula ya existe.";
            } else {
                $error = "Error al guardar: " . $e->getMessage();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agregar Alumno - Clio</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="page-header">
            <h2>Registrar Nuevo Alumno</h2>
            <a href="students.php" class="btn-primary"
                style="background-color: #6c757d; width: auto; display: inline-block;">Volver al Listado</a>
        </header>

        <div class="auth-card" style="margin: 0 auto;">
            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success">
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="form-group">
                    <label>Nombre(s)</label>
                    <input type="text" name="first_name" required>
                </div>
                <div class="form-group">
                    <label>Apellidos</label>
                    <input type="text" name="last_name" required>
                </div>
                <div class="form-group">
                    <label>Matrícula</label>
                    <input type="text" name="enrollment_id" required>
                </div>
                <div class="form-group">
                    <label>Grado y Grupo</label>
                    <input type="text" name="grade_group" placeholder="Ej: 3-A">
                </div>
                <button type="submit" class="btn-primary">Guardar Alumno</button>
            </form>
        </div>
    </div>
</body>

</html>