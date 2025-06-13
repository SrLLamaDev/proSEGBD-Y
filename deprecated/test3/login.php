<?php
session_start();

// db.php - Conexión a la base de datos
$host = '127.0.0.1';
$dbname = 'educativo';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Función para verificar credenciales
function verificarCredenciales($pdo, $password) {
    // Buscar en docentes
    $stmt = $pdo->prepare("SELECT * FROM docentes WHERE correo = ?");

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Si no se encuentra en docentes, buscar en estudiantes
    if (!$usuario) {
        $stmt = $pdo->prepare("SELECT * FROM estudiantes WHERE correo = ?");

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        $tipo = 'estudiante';
    } else {
        $tipo = 'docente';
    }
    
    // Verificar si se encontró el usuario y si la contraseña coincide
    if ($usuario) {
        // En un sistema real, aquí se verificaría con password_verify()
        // Para este ejemplo, usaremos una comparación directa
        if ($password === 'admin123') { // Contraseña por defecto
            return [
                'id' => $usuario['id_'.$tipo],
                'nombre' => $usuario['nombre'],
                'apellido' => $usuario['apellido'],
 
                'tipo' => $tipo
            ];
        }
    }
    
    return false;
}

// Procesar el formulario de login
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $usuario = verificarCredenciales($pdo, $password);
    
    if ($usuario) {
        $_SESSION['usuario'] = $usuario;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = "Credenciales inválidas. Por favor intenta de nuevo.";
    }
}

// Si ya está autenticado, redirigir al dashboard
if (isset($_SESSION['usuario'])) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Sistema Educativo</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #4e54c8, #8f94fb);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .login-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 450px;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .login-header i {
            font-size: 3.5rem;
            color: #4e54c8;
            margin-bottom: 15px;
        }
        
        .login-header h1 {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 10px;
        }
        
        .login-header p {
            color: #777;
        }
        
        .login-form .input-group {
            margin-bottom: 25px;
            position: relative;
        }
        
        .login-form .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
        }
        
        .login-form input {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .login-form input:focus {
            border-color: #4e54c8;
            box-shadow: 0 0 0 3px rgba(78, 84, 200, 0.2);
            outline: none;
        }
        
        .btn-login {
            background: #4e54c8;
            background: linear-gradient(to right, #4e54c8, #8f94fb);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: 500;
            width: 100%;
            transition: all 0.3s ease;
            margin-top: 10px;
        }
        
        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 15px rgba(78, 84, 200, 0.4);
        }
        
        .error-message {
            background: #ffebee;
            color: #e53935;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
        }
        
        .error-message i {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .remember {
            display: flex;
            align-items: center;
        }
        
        .remember input {
            margin-right: 8px;
            width: auto;
        }
        
        .forgot-password {
            color: #4e54c8;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .forgot-password:hover {
            color: #3f44b0;
            text-decoration: underline;
        }
        
        .login-footer {
            text-align: center;
            margin-top: 30px;
            color: #777;
        }
        
        .login-footer a {
            color: #4e54c8;
            text-decoration: none;
            font-weight: 500;
        }
        
        .login-footer a:hover {
            text-decoration: underline;
        }
        
        .decoration {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, #4e54c8, #8f94fb);
        }
        
        .decoration-circle {
            position: absolute;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: rgba(143, 148, 251, 0.1);
            bottom: -60px;
            right: -60px;
            z-index: 0;
        }
        
        @media (max-width: 480px) {
            .login-container {
                margin: 0 20px;
                padding: 30px;
            }
            
            .remember-forgot {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .forgot-password {
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="decoration"></div>
        <div class="decoration-circle"></div>
        
        <div class="login-header">
            <i class="fas fa-graduation-cap"></i>
            <h1>Sistema Educativo</h1>
            <p>Ingresa tus credenciales para acceder</p>
        </div>
        
        <?php if ($error): ?>
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i>
                <span><?php echo $error; ?></span>
            </div>
        <?php endif; ?>
        
        <form class="login-form" method="POST">
            
            
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Contraseña" required>
            </div>
            
            <div class="remember-forgot">
                <div class="remember">
                    <input type="checkbox" id="remember">
                    <label for="remember">Recordarme</label>
                </div>
                <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>
            </div>
            
            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
            </button>
        </form>
        
        <div class="login-footer">
            <p>¿No tienes una cuenta? <a href="#">Contacta al administrador</a></p>
            <p>&copy; <?php echo date('Y'); ?> - Sistema Educativo</p>
        </div>
    </div>
    
    <script>
        // Efecto de vibración al ingresar credenciales incorrectas
        <?php if ($error): ?>
            setTimeout(() => {
                const form = document.querySelector('.login-form');
                form.classList.add('shake');
                setTimeout(() => {
                    form.classList.remove('shake');
                }, 500);
            }, 100);
            
            // Agregar clase de animación
            document.head.insertAdjacentHTML('beforeend', `
                <style>
                    .shake {
                        animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
                    }
                    
                    @keyframes shake {
                        10%, 90% { transform: translateX(-1px); }
                        20%, 80% { transform: translateX(2px); }
                        30%, 50%, 70% { transform: translateX(-4px); }
                        40%, 60% { transform: translateX(4px); }
                    }
                </style>
            `);
        <?php endif; ?>
        
        // Mostrar/ocultar contraseña
        document.querySelector('.input-group:last-child').insertAdjacentHTML('beforeend', `
            <i class="fas fa-eye" id="togglePassword" style="left: auto; right: 15px; cursor: pointer;"></i>
        `);
        
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.querySelector('input[name="password"]');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>