<?php
require_once 'includes/auth.php';
requireLogin();

$db = Database::getInstance();
$stmt = $db->query("SELECT * FROM students ORDER BY last_name ASC, first_name ASC");
$students = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Alumnos - Clio</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: var(--box-shadow);
            border-radius: 8px;
            overflow: hidden;
        }

        th,
        td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover {
            background-color: #f1f3f5;
        }
    </style>
</head>

<body>
    <header style="background: white; padding: 1rem 2rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 2rem;">
        <div class="container" style="display: flex; justify-content: space-between; align-items: center; padding: 0;">
            <h1 style="margin: 0;">Gestión de Alumnos</h1>
            <nav>
                <a href="index.php" style="margin-right: 15px; text-decoration: none; color: #333;">Dashboard</a>
                <a href="logout.php" style="color: red; text-decoration: none;">Salir</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <div class="page-header">
            <h2>Listado de Alumnos</h2>
            <a href="student_add.php" class="btn-primary" style="width: auto; display: inline-block;">+ Nuevo Alumno</a>
        </div>

        <?php if (count($students) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Matrícula</th>
                        <th>Apellidos</th>
                        <th>Nombre</th>
                        <th>Grupo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td>
                                <?php echo htmlspecialchars($student['enrollment_id']); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($student['last_name']); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($student['first_name']); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($student['grade_group']); ?>
                            </td>
                            <td>
                                <a href="#" style="color: var(--primary-color);">Editar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="text-align: center; color: #666;">No hay alumnos registrados aún.</p>
        <?php endif; ?>
    </div>
</body>

</html>