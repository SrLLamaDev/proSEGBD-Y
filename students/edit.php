<?php
require_once '../auth/check_login.php';
require_once '../config/db.php';
require_once '../config/encryption.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: list.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    header("Location: list.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = encryptData($_POST['nombre']);
    $correo = encryptData($_POST['correo']);
    $ci     = encryptData($_POST['ci']);

    $stmt = $pdo->prepare("UPDATE students SET nombre = ?, correo = ?, ci = ? WHERE id = ?");
    $stmt->execute([$nombre, $correo, $ci, $id]);

    header("Location: list.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Estudiante</title>
</head>
<body>
    <h2>Editar Estudiante</h2>
    <form method="POST">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" value="<?php echo htmlspecialchars(decryptData($student['nombre'])); ?>" required><br><br>

        <label>Correo:</label><br>
        <input type="email" name="correo" value="<?php echo htmlspecialchars(decryptData($student['correo'])); ?>" required><br><br>

        <label>CI:</label><br>
        <input type="text" name="ci" value="<?php echo htmlspecialchars(decryptData($student['ci'])); ?>" required><br><br>

        <button type="submit">Actualizar</button>
    </form>
    <br>
    <a href="list.php">Volver a la lista</a>
</body>
</html>
