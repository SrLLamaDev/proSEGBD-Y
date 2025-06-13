<?php
require_once '../auth/check_login.php';
require_once '../config/db.php';
require_once '../config/encryption.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: list.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM subjects WHERE id = ?");
$stmt->execute([$id]);
$subject = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$subject) {
    header("Location: list.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = encryptData($_POST['nombre']);
    $descripcion = encryptData($_POST['descripcion']);

    $stmt = $pdo->prepare("UPDATE subjects SET nombre = ?, descripcion = ? WHERE id = ?");
    $stmt->execute([$nombre, $descripcion, $id]);

    header("Location: list.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Materia</title>
</head>
<body>
    <h2>Editar Materia</h2>
    <form method="POST">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" value="<?php echo htmlspecialchars(decryptData($subject['nombre'])); ?>" required><br><br>

        <label>Descripción:</label><br>
        <textarea name="descripcion" required><?php echo htmlspecialchars(decryptData($subject['descripcion'])); ?></textarea><br><br>

        <button type="submit">Actualizar</button>
    </form>
    <br>
    <a href="list.php">Volver a la lista</a>
</body>
</html>
