<?php
require_once 'config.php';

echo "<h1>Instalación de Base de Datos - Clio</h1>";

try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $conn = new PDO($dsn, DB_USER, DB_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<p>Conexión exitosa...</p>";

    $sql = file_get_contents(__DIR__ . '/sql/schema.sql');

    // Separar por ; para ejecutar sentencias individuales si es necesario, 
    // pero PDO puede manejar múltiples si la configuración lo permite.
    // Para mayor seguridad/compatibilidad, ejecutamos el bloque completo.

    $conn->exec($sql);

    echo "<p style='color: green;'>¡Tablas creadas/verificadas correctamente!</p>";
    echo "<p>Ahora intenta registrarte en <a href='register.php'>register.php</a></p>";
    echo "<p><strong>NOTA:</strong> Borra este archivo (install.php) después de usarlo por seguridad.</p>";

} catch (PDOException $e) {
    echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
}
?>