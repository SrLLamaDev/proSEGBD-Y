<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistema Educativo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --accent: #4895ef;
            --light: #f8f9fa;
            --dark: #212529;
            --success: #4cc9f0;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .login-container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 1000px;
            display: flex;
            min-height: 600px;
        }
        
        .login-left {
            flex: 1;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        .login-left::before {
            content: "";
            position: absolute;
            width: 200%;
            height: 200%;
            top: -50%;
            left: -50%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            transform: rotate(30deg);
        }
        
        .login-right {
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo i {
            font-size: 3rem;
            color: var(--primary);
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .logo h2 {
            font-weight: 700;
            margin-top: 15px;
            color: var(--dark);
        }
        
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }
        
        .form-control {
            padding: 15px 15px 15px 45px;
            border-radius: 10px;
            border: 2px solid #e1e5ee;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
        }
        
        .form-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 18px;
        }
        
        .role-selector {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }
        
        .role-option {
            flex: 1;
            text-align: center;
            padding: 15px 10px;
            background-color: #f1f3f9;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s;
            border: 2px solid transparent;
        }
        
        .role-option:hover {
            background-color: #e2e6f4;
        }
        
        .role-option.selected {
            background-color: rgba(67, 97, 238, 0.1);
            border-color: var(--primary);
            color: var(--primary);
        }
        
        .role-option i {
            font-size: 24px;
            margin-bottom: 10px;
            display: block;
        }
        
        .btn-login {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border: none;
            padding: 15px;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.3s;
            margin-top: 10px;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 14px rgba(67, 97, 238, 0.3);
        }
        
        .forgot-password {
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
        }
        
        .forgot-password a {
            color: var(--primary);
            text-decoration: none;
        }
        
        .features-list {
            list-style: none;
            padding: 0;
            margin-top: 40px;
        }
        
        .features-list li {
            padding: 10px 0;
            padding-left: 35px;
            position: relative;
            margin-bottom: 15px;
        }
        
        .features-list li i {
            position: absolute;
            left: 0;
            top: 12px;
            background: rgba(255, 255, 255, 0.2);
            width: 25px;
            height: 25px;
            border-radius: 50%;
            text-align: center;
            line-height: 25px;
        }
        
        .alert-danger {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 25px;
            border: 1px solid rgba(220, 53, 69, 0.2);
        }
        
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                max-width: 500px;
            }
            
            .login-left {
                padding: 30px;
            }
            
            .login-right {
                padding: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-left">
            <h1 class="display-4 fw-bold">Bienvenido al Sistema Educativo</h1>
            <p class="lead">Accede a tu cuenta para gestionar tu experiencia educativa</p>
            
            <ul class="features-list">
                <li><i class="fas fa-check"></i> Plataforma segura y confiable</li>
                <li><i class="fas fa-check"></i> Gestión integral del proceso educativo</li>
                <li><i class="fas fa-check"></i> Acceso a recursos exclusivos</li>
                <li><i class="fas fa-check"></i> Comunicación en tiempo real</li>
            </ul>
            
            <div class="mt-auto">
                <p class="mb-0">2025</p>
            </div>
        </div>
        
        <div class="login-right">
            <div class="logo">
                <i class="fas fa-graduation-cap"></i>
                <h2>Iniciar Sesión</h2>
            </div>
            
            <!-- Mensaje de error (se mostrará solo si existe) -->
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i> <?php echo htmlspecialchars($_GET['error']); ?>
                </div>
            <?php endif; ?>
            
            <form action="login.php" method="post">
                <!-- Selector de rol con estilo mejorado -->
                <div class="role-selector">
                    <div class="role-option" data-role="1">
                        <i class="fas fa-user-shield"></i>
                        <div>Administrador</div>
                    </div>
                    <div class="role-option" data-role="2">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <div>Profesor</div>
                    </div>
                    <div class="role-option" data-role="3">
                        <i class="fas fa-user-graduate"></i>
                        <div>Estudiante</div>
                    </div>
                </div>
                
                <input type="hidden" name="role" id="selectedRole" value="1">
                
                <div class="form-group">
                    <i class="fas fa-user form-icon"></i>
                    <input type="text" class="form-control" name="uname" placeholder="Nombre de usuario" required>
                </div>
                
                <div class="form-group">
                    <i class="fas fa-lock form-icon"></i>
                    <input type="password" class="form-control" name="pass" placeholder="Contraseña" required>
                </div>
                
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i> Iniciar Sesión
                    </button>
                </div>
                
                <div class="forgot-password">
                    <a href="#"><i class="fas fa-key me-1"></i> ¿Olvidaste tu contraseña?</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Script para manejar la selección de roles
        document.querySelectorAll('.role-option').forEach(option => {
            option.addEventListener('click', function() {
                // Remover clase 'selected' de todas las opciones
                document.querySelectorAll('.role-option').forEach(el => {
                    el.classList.remove('selected');
                });
                
                // Agregar clase 'selected' a la opción clickeada
                this.classList.add('selected');
                
                // Actualizar el valor del campo oculto
                document.getElementById('selectedRole').value = this.getAttribute('data-role');
            });
        });
        
        // Seleccionar Administrador por defecto
        document.querySelector('.role-option[data-role="1"]').classList.add('selected');
    </script>
</body>
</html>