<?php
// Configuración de la Base de Datos
define('DB_HOST', 'localhost');
define('DB_NAME', 'unrealc1_edusys');
define('DB_USER', 'unrealc1_edu_adm');
define('DB_PASS', 'EDUsys,.-123');

// Configuración del Sistema
// Detectar automáticamente si estamos en localhost o en producción para la URL base
if ($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '127.0.0.1') {
    define('BASE_URL', 'http://localhost/clio/');
} else {
    define('BASE_URL', 'https://unrealcodex.com/clio/');
}

// Zona horaria
date_default_timezone_set('America/Mexico_City');

// Mostrar errores (Desactivar en producción)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>