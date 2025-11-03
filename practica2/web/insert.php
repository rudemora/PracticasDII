<?php
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo "Método no permitido";
    exit;
}

$nombre = trim($_POST['nombre'] ?? '');
$email = trim($_POST['email'] ?? '');

if ($nombre === '' || $email === '') {
    // Redirige con error simple (puedes mejorar mostrando mensajes)
    header('Location: index.php');
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO estudiantes (nombre, email) VALUES (:nombre, :email)");
    $stmt->execute([':nombre' => $nombre, ':email' => $email]);
    // Redirect para evitar reenvío de formulario
    header('Location: index.php?ok=1');
    exit;
} catch (PDOException $e) {
    // En desarrollo muestra el mensaje; en producción loguea y muestra mensaje genérico
    die("Error al insertar: " . htmlspecialchars($e->getMessage()));
}
