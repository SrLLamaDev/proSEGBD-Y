<?php require_once __DIR__ . '/../templates/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Detalles del Estudiante</h1>
    <a href="students.php" class="btn btn-secondary">Volver</a>
</div>

<div class="card">
    <div class="card-body">
        <?php if ($student): ?>
            <div class="row mb-4">
                <div class="col-md-6">
                    <h3>Información Personal</h3>
                    <p><strong>Nombre:</strong> <?= htmlspecialchars($student['nombre_completo']) ?></p>
                    <p><strong>DNI:</strong> <?= htmlspecialchars($student['dni']) ?></p>
                    <p><strong>Dirección:</strong> <?= htmlspecialchars($student['direccion']) ?></p>
                    <p><strong>Teléfono:</strong> <?= htmlspecialchars($student['telefono'] ?? 'N/A') ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($student['email']) ?></p>
                </div>
                <div class="col-md-6">
                    <h3>Datos Médicos</h3>
                    <p><?= nl2br(htmlspecialchars($student['historial_medico'] ?? 'Sin información médica')) ?></p>
                </div>
            </div>
            
            <div class="alert alert-info">
                <strong>Nota:</strong> Estos datos fueron desencriptados usando la clave secreta almacenada en el servidor.
            </div>
            
            <div class="d-flex">
                <a href="students.php?action=editForm&id=<?= $student['id'] ?>" class="btn btn-warning me-2">Editar</a>
                <a href="students.php?action=delete&id=<?= $student['id'] ?>" class="btn btn-danger" onclick="return confirm('¿Eliminar este estudiante?')">Eliminar</a>
            </div>
        <?php else: ?>
            <div class="alert alert-danger">Estudiante no encontrado</div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>