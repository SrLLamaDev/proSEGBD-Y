<?php
$host = 'localhost';
$dbname = 'educa';
$user = 'root'; // cámbialo si usas otro usuario
$pass = 'aaaa';     // y agrega tu contraseña si tienes una

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    // Activamos modo de errores
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
?>
