<?php
require_once '../auth/check_login.php';
require_once '../config/db.php';
require_once '../config/encryption.php';

$stmt = $pdo->query("SELECT * FROM subjects");
$subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Materias</title>
</head>
<body>
    <h2>Lista de Materias</h2>
    <a href="add.php">Agregar Nueva Materia</a> |
    <a href="../public/dashboard.php">Volver al Panel</a><br><br>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($subjects as $subject): ?>
        <tr>
            <td><?php echo $subject['id']; ?></td>
            <td><?php echo htmlspecialchars(decryptData($subject['nombre'])); ?></td>
            <td><?php echo htmlspecialchars(decryptData($subject['descripcion'])); ?></td>
            <td>
                <a href="edit.php?id=<?php echo $subject['id']; ?>">Editar</a> |
                <a href="delete.php?id=<?php echo $subject['id']; ?>" onclick="return confirm('¿Eliminar materia?');">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
