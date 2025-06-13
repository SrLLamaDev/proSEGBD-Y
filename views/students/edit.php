<?php require_once __DIR__ . '/../templates/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Editar Estudiante</h1>
    <a href="students.php" class="btn btn-secondary">Volver</a>
</div>

<div class="card">
    <div class="card-body">
        <?php if ($student): ?>
            <form action="students.php?action=update&id=<?= $student['id'] ?>" method="post">
                <div class="mb-3">
                    <label for="nombre_completo" class="form-label">Nombre Completo</label>
                    <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" 
                           value="<?= htmlspecialchars($student['nombre_completo']) ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="dni" class="form-label">DNI</label>
                    <input type="text" class="form-control" id="dni" name="dni" 
                           value="<?= htmlspecialchars($student['dni']) ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" 
                           value="<?= htmlspecialchars($student['direccion']) ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" 
                           value="<?= htmlspecialchars($student['telefono'] ?? '') ?>">
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" 
                           value="<?= htmlspecialchars($student['email']) ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="historial_medico" class="form-label">Historial Médico</label>
                    <textarea class="form-control" id="historial_medico" name="historial_medico" rows="3"><?= 
                        htmlspecialchars($student['historial_medico'] ?? '') 
                    ?></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">Actualizar Estudiante</button>
            </form>
        <?php else: ?>
            <div class="alert alert-danger">Estudiante no encontrado</div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>