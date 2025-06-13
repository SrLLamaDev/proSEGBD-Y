<?php
// db.php - Conexión a la base de datos
$host = '127.0.0.1';
$dbname = 'educativo';
$username = 'root'; // Cambia según tu configuración
$password = '';     // Cambia según tu configuración

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Función para obtener todos los estudiantes
function getEstudiantes($pdo) {
    $stmt = $pdo->query("SELECT * FROM estudiantes");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para obtener todos los docentes
function getDocentes($pdo) {
    $stmt = $pdo->query("SELECT * FROM docentes");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para obtener todos los cursos
function getCursos($pdo) {
    $stmt = $pdo->query("SELECT * FROM cursos");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para obtener todas las matrículas
function getMatriculas($pdo) {
    $stmt = $pdo->query("SELECT * FROM matriculas");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para obtener todas las calificaciones
function getCalificaciones($pdo) {
    $stmt = $pdo->query("SELECT * FROM calificaciones");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Educativo</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }
        
        header {
            background: linear-gradient(135deg, #4e54c8, #8f94fb);
            color: white;
            padding: 1.5rem 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
        }
        
        .logo i {
            margin-right: 10px;
            font-size: 2rem;
        }
        
        nav ul {
            display: flex;
            list-style: none;
        }
        
        nav ul li {
            margin-left: 25px;
        }
        
        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            padding: 8px 15px;
            border-radius: 20px;
            transition: all 0.3s ease;
        }
        
        nav ul li a:hover, 
        nav ul li a.active {
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        .dashboard {
            padding: 40px 0;
        }
        
        .dashboard-header {
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .dashboard-header h1 {
            font-size: 2rem;
            color: #4e54c8;
        }
        
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-card i {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: #4e54c8;
        }
        
        .stat-card h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #333;
        }
        
        .stat-card p {
            color: #777;
        }
        
        .section {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
        }
        
        .section-header h2 {
            font-size: 1.5rem;
            color: #4e54c8;
        }
        
        .btn {
            background: #4e54c8;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            transition: background 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn:hover {
            background: #3f44b0;
        }
        
        .btn-add {
            background: #4CAF50;
        }
        
        .btn-add:hover {
            background: #3d8b40;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        
        table th, table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        
        table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #555;
        }
        
        table tr:hover {
            background-color: #f5f7ff;
        }
        
        .actions {
            display: flex;
            gap: 10px;
        }
        
        .btn-edit {
            background: #FFC107;
            color: #333;
        }
        
        .btn-edit:hover {
            background: #e0a800;
        }
        
        .btn-delete {
            background: #dc3545;
        }
        
        .btn-delete:hover {
            background: #bd2130;
        }
        
        footer {
            background: #333;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 40px;
        }
        
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                text-align: center;
            }
            
            nav ul {
                margin-top: 20px;
                justify-content: center;
            }
            
            nav ul li {
                margin: 0 10px;
            }
            
            .dashboard-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .dashboard-header .btn {
                margin-top: 15px;
            }
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Sistema Educativo</span>
                </div>
                <nav>
                    <ul>
                        <li><a href="#" class="active"><i class="fas fa-home"></i> Inicio</a></li>
                        <li><a href="#"><i class="fas fa-user-graduate"></i> Estudiantes</a></li>
                        <li><a href="#"><i class="fas fa-chalkboard-teacher"></i> Docentes</a></li>
                        <li><a href="#"><i class="fas fa-book"></i> Cursos</a></li>
                        <li><a href="#"><i class="fas fa-clipboard-list"></i> Matrículas</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <div class="dashboard">
        <div class="container">
            <div class="dashboard-header">
                <h1>Panel de Administración</h1>
                <a href="#" class="btn btn-add"><i class="fas fa-plus"></i> Nuevo Estudiante</a>
            </div>
            
            <div class="stats">
                <div class="stat-card">
                    <i class="fas fa-user-graduate"></i>
                    <h3><?php echo count(getEstudiantes($pdo)); ?></h3>
                    <p>Estudiantes</p>
                </div>
                
                <div class="stat-card">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <h3><?php echo count(getDocentes($pdo)); ?></h3>
                    <p>Docentes</p>
                </div>
                
                <div class="stat-card">
                    <i class="fas fa-book"></i>
                    <h3><?php echo count(getCursos($pdo)); ?></h3>
                    <p>Cursos</p>
                </div>
                
                <div class="stat-card">
                    <i class="fas fa-clipboard-list"></i>
                    <h3><?php echo count(getMatriculas($pdo)); ?></h3>
                    <p>Matrículas</p>
                </div>
            </div>
            
            <div class="section">
                <div class="section-header">
                    <h2><i class="fas fa-user-graduate"></i> Estudiantes Registrados</h2>
                    <a href="#" class="btn btn-add"><i class="fas fa-plus"></i> Agregar</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Fecha Nac.</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (getEstudiantes($pdo) as $estudiante): ?>
                        <tr>
                            <td><?php echo $estudiante['id_estudiante']; ?></td>
                            <td><?php echo $estudiante['nombre']; ?></td>
                            <td><?php echo $estudiante['apellido']; ?></td>
                            <td><?php echo $estudiante['correo']; ?></td>
                            <td><?php echo $estudiante['telefono']; ?></td>
                            <td><?php echo $estudiante['fecha_nacimiento']; ?></td>
                            <td class="actions">
                                <a href="#" class="btn btn-edit"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-delete"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="section">
                <div class="section-header">
                    <h2><i class="fas fa-chalkboard-teacher"></i> Docentes</h2>
                    <a href="#" class="btn btn-add"><i class="fas fa-plus"></i> Agregar</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Título</th>
                            <th>Teléfono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (getDocentes($pdo) as $docente): ?>
                        <tr>
                            <td><?php echo $docente['id_docente']; ?></td>
                            <td><?php echo $docente['nombre']; ?></td>
                            <td><?php echo $docente['apellido']; ?></td>
                            <td><?php echo $docente['correo']; ?></td>
                            <td><?php echo $docente['titulo_academico']; ?></td>
                            <td><?php echo $docente['telefono']; ?></td>
                            <td class="actions">
                                <a href="#" class="btn btn-edit"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-delete"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="section">
                <div class="section-header">
                    <h2><i class="fas fa-book"></i> Cursos</h2>
                    <a href="#" class="btn btn-add"><i class="fas fa-plus"></i> Agregar</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Docente</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (getCursos($pdo) as $curso): ?>
                        <tr>
                            <td><?php echo $curso['id_curso']; ?></td>
                            <td><?php echo $curso['nombre_curso']; ?></td>
                            <td><?php echo $curso['descripcion']; ?></td>
                            <td><?php 
                                // En un sistema real, aquí buscaríamos el nombre del docente por su ID
                                echo "Docente ID: " . $curso['id_docente']; 
                            ?></td>
                            <td class="actions">
                                <a href="#" class="btn btn-edit"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-delete"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="section">
                <div class="section-header">
                    <h2><i class="fas fa-clipboard-list"></i> Matrículas</h2>
                    <a href="#" class="btn btn-add"><i class="fas fa-plus"></i> Agregar</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>ID Matrícula</th>
                            <th>Estudiante</th>
                            <th>Curso</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (getMatriculas($pdo) as $matricula): ?>
                        <tr>
                            <td><?php echo $matricula['id_matricula']; ?></td>
                            <td><?php 
                                // En un sistema real, aquí buscaríamos el nombre del estudiante
                                echo "Estudiante ID: " . $matricula['id_estudiante']; 
                            ?></td>
                            <td><?php 
                                // En un sistema real, aquí buscaríamos el nombre del curso
                                echo "Curso ID: " . $matricula['id_curso']; 
                            ?></td>
                            <td><?php echo $matricula['fecha_matricula']; ?></td>
                            <td class="actions">
                                <a href="#" class="btn btn-edit"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-delete"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="section">
                <div class="section-header">
                    <h2><i class="fas fa-star"></i> Calificaciones</h2>
                    <a href="#" class="btn btn-add"><i class="fas fa-plus"></i> Agregar</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>ID Calificación</th>
                            <th>Matrícula</th>
                            <th>Nota</th>
                            <th>Observaciones</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (getCalificaciones($pdo) as $calificacion): ?>
                        <tr>
                            <td><?php echo $calificacion['id_calificacion']; ?></td>
                            <td><?php 
                                // En un sistema real, aquí mostraríamos información de la matrícula
                                echo "Matrícula ID: " . $calificacion['id_matricula']; 
                            ?></td>
                            <td><?php echo $calificacion['nota']; ?></td>
                            <td><?php echo $calificacion['observaciones'] ?: 'Ninguna'; ?></td>
                            <td class="actions">
                                <a href="#" class="btn btn-edit"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-delete"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>Sistema Educativo &copy; <?php echo date('Y'); ?> - Todos los derechos reservados</p>
        </div>
    </footer>
</body>
</html>