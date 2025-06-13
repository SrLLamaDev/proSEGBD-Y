<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sistema Escolar</title>
    <link rel="stylesheet" href="../public/style.css"> <!-- Opcional -->
</head>
<body>
    <header>
        <h2>Sistema Escolar</h2>
        <?php if (isset($_SESSION['username'])): ?>
            <p>Usuario: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
            <nav>
                <a href="../students/list.php">Estudiantes</a> |
                <a href="../subjects/list.php">Materias</a> |
                <a href="../public/dashboard.php">Panel</a> |
                <a href="../public/logout.php">Cerrar Sesión</a>
            </nav>
        <?php endif; ?>
        <hr>
    </header>
