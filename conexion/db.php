<?php
// db.php
function obtenerConexion()
{
    $host = "127.0.0.1";
    $nombreBD = "tfg";
    $port = 3307;
    $usuario = "root";
    $password = "";
    try {
        $conexion = new PDO(
            "mysql:host=$host;dbname=$nombreBD;port=$port;charset=utf8mb4",
            $usuario,
            $password
        );
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;
    } catch (PDOException $e) {


        echo "Error de conexión: " . $e->getMessage();
        exit;
    }
}
