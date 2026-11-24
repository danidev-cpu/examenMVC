<?php
require_once __DIR__ . "/../conexion/db.php";

class UsersModel
{
    public $conexion;

    public function __construct()
    {
        $this->conexion = obtenerConexion();
    }

    public function obtenerUsuarios()
    {
        $sql = "SELECT id, nombre, apellido1, apellido2, profesor1, profesor2, profesor3, profesor4 FROM notas ORDER BY id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerUsuariosParaProfesor(string $profesor)
    {
        $columna = $this->obtenerColumnaNotaProfesor($profesor);
        $sql = "SELECT id, nombre, apellido1, apellido2, $columna AS nota FROM notas ORDER BY id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerUsuarioParaProfesor(int $id, string $profesor)
    {
        $columna = $this->obtenerColumnaNotaProfesor($profesor);
        $sql = "SELECT id, nombre, apellido1, apellido2, $columna AS nota FROM notas WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarNota(int $id, string $profesor, string $nota)
    {
        $columna = $this->obtenerColumnaNotaProfesor($profesor);
        $sql = "UPDATE notas SET $columna = :nota WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':nota', $nota);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    private function obtenerColumnaNotaProfesor(string $profesor): string
    {
        $columnas = ['profesor1', 'profesor2', 'profesor3', 'profesor4'];
        if (!in_array($profesor, $columnas, true)) {
            throw new ErrorException('Profesor no válido.');
        }

        return $profesor;
    }
}
