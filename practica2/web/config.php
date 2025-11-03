<?php
// config.php
// Lee configuración desde variables de entorno (recomendado para Azure).
$db_host = getenv('DB_HOST') ?: 'localhost';
$db_name = getenv('DB_NAME') ?: 'webdb';
$db_user = getenv('DB_USER') ?: 'webuser';
$db_pass = getenv('DB_PASS') ?: 'password123';

$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

// Si necesitas SSL (Azure): puedes añadir PDO::MYSQL_ATTR_SSL_CA => '/path/to/BaltimoreCyberTrustRoot.crt.pem'
try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $e) {
    // Mensaje amigable en desarrollo; en producción loguear en fichero
    die("Error de conexión a la base de datos: " . htmlspecialchars($e->getMessage()));
}
