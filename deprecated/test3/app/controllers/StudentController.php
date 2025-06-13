<?php
// app/controllers/StudentController.php

require_once __DIR__ . '/../models/Student.php';

class StudentController {
    private $studentModel;

    public function __construct() {
        $this->studentModel = new Student();
    }

    // Mostrar formulario de creación
    public function createForm() {
        require_once __DIR__ . '/../../views/students/create.php';
    }

    // Procesar creación de estudiante
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre_completo' => $_POST['nombre_completo'],
                'dni' => $_POST['dni'],
                'direccion' => $_POST['direccion'],
                'telefono' => $_POST['telefono'] ?? null,
                'historial_medico' => $_POST['historial_medico'] ?? null,
                'email' => $_POST['email']
            ];

            if ($this->studentModel->create($data)) {
                header('Location: /sistema-escolar/public/students.php?success=1');
            } else {
                header('Location: /sistema-escolar/public/students.php?error=1');
            }
        }
    }

    // Mostrar detalles de estudiante
    public function show($id) {
        $student = $this->studentModel->getById($id);
        require_once __DIR__ . '/../../views/students/show.php';
    }

    // Listar estudiantes (mostrando datos encriptados)
    public function indexEncrypted() {
        $students = $this->studentModel->getAllEncrypted();
        require_once __DIR__ . '/../../views/students/index_encrypted.php';
    }

    // Mostrar formulario de edición
    public function editForm($id) {
        $student = $this->studentModel->getById($id);
        require_once __DIR__ . '/../../views/students/edit.php';
    }

    // Procesar actualización
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre_completo' => $_POST['nombre_completo'],
                'dni' => $_POST['dni'],
                'direccion' => $_POST['direccion'],
                'telefono' => $_POST['telefono'] ?? null,
                'historial_medico' => $_POST['historial_medico'] ?? null,
                'email' => $_POST['email']
            ];

            if ($this->studentModel->update($id, $data)) {
                header("Location: /sistema-escolar/public/students.php?action=show&id=$id&success=1");
            } else {
                header("Location: /sistema-escolar/public/students.php?action=edit&id=$id&error=1");
            }
        }
    }

    // Eliminar estudiante
    public function delete($id) {
        if ($this->studentModel->delete($id)) {
            header('Location: /sistema-escolar/public/students.php?success=1');
        } else {
            header('Location: /sistema-escolar/public/students.php?error=1');
        }
    }
}