<?php
session_start();
require_once '../auth/check_login.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Panel de Control - Admin</title>
</head>
<body>
    <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>

    <ul>
        <li><a href="../students/list.php">CRUD Estudiantes</a></li>
        <li><a href="../subjects/list.php">CRUD Materias</a></li>
        <li><a href="logout.php">Cerrar Sesión</a></li>
    </ul>
</body>
</html>
