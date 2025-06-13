<?php
require_once '../auth/check_login.php';
require_once '../config/db.php';
require_once '../config/encryption.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = encryptData($_POST['nombre']);
    $descripcion = encryptData($_POST['descripcion']);

    $stmt = $pdo->prepare("INSERT INTO subjects (nombre, descripcion) VALUES (?, ?)");
    $stmt->execute([$nombre, $descripcion]);

    header("Location: list.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Materia</title>
</head>
<body>
    <h2>Nueva Materia</h2>
    <form method="POST">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Descripción:</label><br>
        <textarea name="descripcion" required></textarea><br><br>

        <button type="submit">Guardar</button>
    </form>
    <br>
    <a href="list.php">Volver a la lista</a>
</body>
</html>
