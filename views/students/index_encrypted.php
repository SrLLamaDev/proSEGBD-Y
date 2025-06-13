<?php require_once __DIR__ . '/../templates/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Estudiantes (Datos Encriptados)</h1>
    <a href="students.php?action=createForm" class="btn btn-primary">Nuevo Estudiante</a>
</div>

<div class="card">
    <div class="card-body">
        <p class="text-muted mb-4">
            Estos son los datos como se almacenan en la base de datos. Los datos sensibles están encriptados.
            <a href="students.php?action=showAllDecrypted" class="ms-2">Ver datos desencriptados</a>
        </p>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Nombre (Encriptado)</th>
                    <th>DNI (Encriptado)</th>
                    <th>Dirección (Encriptado)</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= htmlspecialchars($student['id']) ?></td>
                    <td><?= htmlspecialchars($student['email']) ?></td>
                    <td class="encrypted-data"><?= htmlspecialchars($student['nombre_encrypted']) ?></td>
                    <td class="encrypted-data"><?= htmlspecialchars($student['dni_encrypted']) ?></td>
                    <td class="encrypted-data"><?= htmlspecialchars($student['direccion_encrypted']) ?></td>
                    <td>
                        <a href="students.php?action=show&id=<?= $student['id'] ?>" class="btn btn-sm btn-info">Ver</a>
                        <a href="students.php?action=editForm&id=<?= $student['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="students.php?action=delete&id=<?= $student['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este estudiante?')">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>