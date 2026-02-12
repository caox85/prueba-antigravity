<?php
require_once 'includes/auth.php';
requireLogin();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Clio</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .dashboard-header {
            background-color: var(--white);
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .welcome-section {
            padding: 2rem;
            background: white;
            border-radius: 8px;
            margin-top: 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body>
    <header class="dashboard-header">
        <h1>Clio System</h1>
        <nav>
            <span>Hola, <strong>
                    <?php echo htmlspecialchars($_SESSION['username']); ?>
                </strong></span>
            <a href="logout.php" style="margin-left: 15px; color: red; text-decoration: none;">Cerrar Sesión</a>
        </nav>
    </header>

    <div class="container">
        <div class="welcome-section">
            <h2>Bienvenido al Sistema de Gestión Escolar</h2>
            <p>Seleccione una opción para comenzar:</p>
            <ul>
                <li><a href="#">Gestionar Alumnos (Próximamente)</a></li>
                <li><a href="#">Reportes (Próximamente)</a></li>
                <!-- Solo visible para admins -->
                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <li><a href="register.php">Registrar Nuevo Usuario</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</body>

</html>