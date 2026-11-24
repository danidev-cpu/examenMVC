<?php


class UsersController
{
    public $modelo;

    public function __construct(?UsersModel $modelo = null)
    {
        $this->modelo = $modelo ?? new UsersModel();
    }

    public function index()
    {
        $username = $_SESSION['username'] ?? '';
        $rol = $_SESSION['rol'] ?? '';
        $esAdmin = $rol === 'admin';

        if ($rol === 'admin') {
            $usuarios = $this->modelo->obtenerUsuarios();
            $profesor = null;
        } elseif ($rol === 'profesor') {
            $usuarios = $this->modelo->obtenerUsuariosParaProfesor($username);
            $profesor = $username;
        } else {
            echo 'Usuario no autorizado.';
            return;
        }

        require_once __DIR__ . "/../vistas/listado.php";
    }

    public function edit(int $id)
    {
        $profesor = $_SESSION['username'] ?? '';
        $rol = $_SESSION['rol'] ?? '';
        if ($rol !== 'profesor') {
            echo 'Solo los profesores pueden editar sus propias notas.';
            return;
        }

        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nota = $_POST['nota'] ?? '';

            if (!is_numeric($nota)) {
                $error = 'Introduce una nota numérica entre 0 y 99,99.';
            } elseif (!$this->modelo->actualizarNota($id, $profesor, $nota)) {
                $error = 'No se pudo guardar la nota.';
            } else {
                header('Location: /index.php');
                exit;
            }
        }

        $usuario = $this->modelo->obtenerUsuarioParaProfesor($id, $profesor);
        if (!$usuario) {
            echo 'Alumno no encontrado.';
            return;
        }

        require __DIR__ . "/../vistas/poner_nota.php";
    }
}
