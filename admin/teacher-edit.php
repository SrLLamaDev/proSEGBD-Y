<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['teacher_id'])) {

    if ($_SESSION['role'] == 'Admin') {
      
       include "../DB_connection.php";
       include "data/subject.php";
       include "data/grade.php";
       include "data/teacher.php";
       $subjects = getAllSubjects($conn);
       $grades = getAllGrades($conn);
       
       $teacher_id = $_GET['teacher_id'];
       $teacher = getTeacherById($teacher_id, $conn);

       if ($teacher == 0) {
         header("Location: teacher.php");
         exit;
       }


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin - Edit Teacher</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/styleTeaEdit.css">
	<link rel="icon" href="../img/logo1.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php include "inc/navbar.php"; ?>
    
    <div class="container mt-5">
        <a href="teacher.php" class="btn btn-dark">
            <i class="fas fa-arrow-left me-2"></i> Go Back
        </a>

        <!-- Formulario de edición principal -->
        <form method="post" class="shadow p-3 mt-5 form-w" action="req/teacher-edit.php">
            <h3><i class="fas fa-user-edit"></i> Edit Teacher</h3>
            <hr>
            
            <!-- Mensajes de alerta -->
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> <?=$_GET['error']?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-check-circle me-2"></i> <?=$_GET['success']?>
                </div>
            <?php endif; ?>
            
            <!-- Campos del formulario -->
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">First name</label>
                        <input type="text" class="form-control" value="<?=$teacher['fname']?>" name="fname">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Last name</label>
                        <input type="text" class="form-control" value="<?=$teacher['lname']?>" name="lname">
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" value="<?=$teacher['username']?>" name="username">
            </div>
            
            <input type="text" value="<?=$teacher['teacher_id']?>" name="teacher_id" hidden>
            
            <!-- Sección de asignaturas -->
            <div class="section-container">
                <div class="section-title">
                    <i class="fas fa-book"></i>
                    <span>Subject</span>
                </div>
                <div class="checkbox-grid">
                    <?php 
                    $subject_ids = str_split(trim($teacher['subjects']));
                    foreach ($subjects as $subject): 
                        $checked = in_array($subject['subject_id'], $subject_ids) ? 'checked' : '';
                    ?>
                    <div class="checkbox-item">
                        <input type="checkbox" name="subjects[]" <?=$checked?> value="<?=$subject['subject_id']?>">
                        <label><?=$subject['subject']?></label>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Sección de grados -->
            <div class="section-container">
                <div class="section-title">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Grade</span>
                </div>
                <div class="checkbox-grid">
                    <?php 
                    $grade_ids = str_split(trim($teacher['grades']));
                    foreach ($grades as $grade): 
                        $checked = in_array($grade['grade_id'], $grade_ids) ? 'checked' : '';
                    ?>
                    <div class="checkbox-item">
                        <input type="checkbox" name="grades[]" <?=$checked?> value="<?=$grade['grade_id']?>">
                        <label><?=$grade['grade_code']?>-<?=$grade['grade']?></label>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-2"></i> Update
            </button>
        </form>

        <!-- Formulario de cambio de contraseña -->
        <form method="post" class="shadow p-3 my-5 form-w" action="req/teacher-change.php" id="change_password">
            <h3><i class="fas fa-key"></i> Change Password</h3>
            <hr>
            
            <!-- Mensajes de alerta para cambio de contraseña -->
            <?php if (isset($_GET['perror'])): ?>
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> <?=$_GET['perror']?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($_GET['psuccess'])): ?>
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-check-circle me-2"></i> <?=$_GET['psuccess']?>
                </div>
            <?php endif; ?>

            <!-- Campos para cambio de contraseña -->
            <div class="mb-3">
                <label class="form-label">Admin password</label>
                <input type="password" class="form-control" name="admin_pass" placeholder="Enter your admin password"> 
            </div>

            <div class="mb-3">
                <label class="form-label">New password</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="new_pass" id="passInput" placeholder="New password">
                    <button class="btn btn-secondary" id="gBtn">
                        <i class="fas fa-random me-2"></i> Random
                    </button>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm new password</label>
                <input type="text" class="form-control" name="c_new_pass" id="passInput2" placeholder="Confirm new password"> 
            </div>
            
            <input type="text" value="<?=$teacher['teacher_id']?>" name="teacher_id" hidden>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-sync-alt me-2"></i> Change Password
            </button>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	
    <script>
        $(document).ready(function(){
            $("#navLinks li:nth-child(2) a").addClass('active');
        });

        function makePass(length) {
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            document.getElementById('passInput').value = result;
            document.getElementById('passInput2').value = result;
        }

        document.getElementById('gBtn').addEventListener('click', function(e){
            e.preventDefault();
            makePass(8);
        });
    </script>
</body>
</html>

<?php 

  }else {
    header("Location: teacher.php");
    exit;
  } 
}else {
	header("Location: teacher.php");
	exit;
} 

?>