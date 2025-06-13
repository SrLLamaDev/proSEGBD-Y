<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Dashboard</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/styleInd.css">
	<link rel="icon" href="../img/logo1.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php include "inc/navbar.php"; ?>
    
    <div class="container mt-5">
        <div class="dashboard-header">
            <h1>Dashboard del administrador</h1>
            <p>Administra tu institución educativa de manera eficiente con nuestras completas herramientas de administración</p>
        </div>
        
        <div class="action-grid">
            <div class="action-card">
                <div class="action-icon">
                    <i class="fas fa-user-md"></i>
                </div>
                <h3>Administrador de docentes</h3>
                <p>Administrar al plantel docente</p>
                <a href="teacher.php" class="btn btn-action">
                    <i class="fas fa-arrow-right me-2"></i> Administrar docentes
                </a>
            </div>
            
            <!-- Puedes agregar más tarjetas de acción aquí cuando necesites -->
            <!-- Ejemplo de tarjeta adicional:
            <div class="action-card">
                <div class="action-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3>Students Management</h3>
                <p>Manage student profiles, classes and performance</p>
                <a href="students.php" class="btn btn-action">
                    <i class="fas fa-arrow-right me-2"></i> Manage Students
                </a>
            </div>
            -->
            
            <div class="action-card logout-card">
                <div class="action-icon">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
                <h3>Salir</h3>
                <p>Salir de forma segura del panel de administración</p>
                <a href="../logout.php" class="btn btn-action">
                    <i class="fas fa-sign-out-alt me-2"></i> Salir
                </a>
            </div>
        </div>
        
        <div class="dashboard-footer">
            <p>2025 uwu</p>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	
    <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(1) a").addClass('active');
        });
    </script>
</body>
</html>