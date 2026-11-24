<?php
session_start();

require_once __DIR__ . "/../modelo/UsersModel.php";

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $usuariosValidos = ['admin', 'profesor1', 'profesor2', 'profesor3', 'profesor4'];

    if (is_string($username) && in_array($username, $usuariosValidos, true)) {
        $_SESSION['username'] = $username;
        $_SESSION['rol'] = $username === 'admin' ? 'admin' : 'profesor';
        header("Location: /index.php");
        exit;
    }

    $error = 'Usuario no válido.';
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
</head>

<body>
    <h1>Iniciar sesión</h1>
    <?php if ($error !== null) { ?>
        <p role="alert"><?= $error ?></p>
    <?php } ?>
    <form method="post">
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Entrar</button>
    </form>
</body>

</html>