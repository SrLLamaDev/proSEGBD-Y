<?php
require_once '../auth/check_login.php';
require_once '../config/db.php';
require_once '../config/encryption.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = encryptData($_POST['nombre']);
    $correo = encryptData($_POST['correo']);
    $ci     = encryptData($_POST['ci']);

    $stmt = $pdo->prepare("INSERT INTO students (nombre, correo, ci) VALUES (?, ?, ?)");
    $stmt->execute([$nombre, $correo, $ci]);

    header("Location: list.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Estudiante</title>
</head>
<body>
    <h2>Nuevo Estudiante</h2>
    <form method="POST">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Correo:</label><br>
        <input type="email" name="correo" required><br><br>

        <label>CI:</label><br>
        <input type="text" name="ci" required><br><br>

        <button type="submit">Guardar</button>
    </form>
    <br>
    <a href="list.php">Volver a la lista</a>
</body>
</html>
