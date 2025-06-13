<?php
require_once '../auth/check_login.php';
require_once '../config/db.php';
require_once '../config/encryption.php';

$stmt = $pdo->query("SELECT * FROM students");
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Estudiantes</title>
</head>
<body>
    <h2>Lista de Estudiantes</h2>
    <a href="add.php">Agregar Nuevo Estudiante</a> | 
    <a href="../public/dashboard.php">Volver al Panel</a><br><br>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>CI</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($students as $student): ?>
        <tr>
            <td><?php echo $student['id']; ?></td>
            <td><?php echo htmlspecialchars(decryptData($student['nombre'])); ?></td>
            <td><?php echo htmlspecialchars(decryptData($student['correo'])); ?></td>
            <td><?php echo htmlspecialchars(decryptData($student['ci'])); ?></td>
            <td>
                <a href="edit.php?id=<?php echo $student['id']; ?>">Editar</a> | 
                <a href="delete.php?id=<?php echo $student['id']; ?>" onclick="return confirm('¿Eliminar estudiante?');">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
