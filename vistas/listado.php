<?php
if (!isset($_SESSION['username'])) {
    header("Location: /index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de alumnos</title>
</head>

<body>



    <h1>Listado de alumnos</h1>
    <h2>Bienvenido, <?= $_SESSION['username'] ?>.</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido 1</th>
                <th>Apellido 2</th>
                <?php if ($esAdmin) { ?>
                    <th>Profesor 1</th>
                    <th>Profesor 2</th>
                    <th>Profesor 3</th>
                    <th>Profesor 4</th>
                <?php } else { ?>
                    <th><?php echo $profesor ?></th>
                    <th>Acción</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario) { ?>
                <tr>
                    <td><?= $usuario['id'] ?></td>
                    <td><?= $usuario['nombre'] ?></td>
                    <td><?= $usuario['apellido1'] ?></td>
                    <td><?= $usuario['apellido2'] ?? '-' ?></td>
                    <?php if ($esAdmin) { ?>
                        <td><?= $usuario['profesor1'] ?? '-' ?></td>
                        <td><?= $usuario['profesor2'] ?? '-' ?></td>
                        <td><?= $usuario['profesor3'] ?? '-' ?></td>
                        <td><?= $usuario['profesor4'] ?? '-' ?></td>
                    <?php } else { ?>
                        <td><?= $usuario['nota'] ?? '-' ?></td>
                        <td><a href="/index.php?action=edit&amp;id=<?= (int) $usuario['id'] ?>">Poner / editar nota</a></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php if (!$usuarios) { ?>
        <p>No hay alumnos en la base de datos.</p>
    <?php } ?>

    <p><a href="/vistas/cerrar_sesion.php">Cerrar sesión</a></p>
</body>

</html>