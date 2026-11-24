<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar nota</title>
</head>


<body>
    <h1>Poner / editar nota</h1>
    <p>
        Alumno:
        <?php echo $usuario['nombre'] . ' ' . $usuario['apellido1'] . ' ' . ($usuario['apellido2'] ?? '') ?>
    </p>
    <p>Nota de <?php echo $profesor ?? '' ?></p>

    <?php if ($error !== null) { ?>
        <p role="alert"><?php echo $error ?></p>
    <?php } ?>

    <form method="post">
        <label for="nota">Nota (0-99,99):</label>
        <input type="number" id="nota" name="nota" min="0" max="99.99" step="0.01"
            value="<?php echo (string) ($usuario['nota'] ?? '') ?>"
            required>
        <button type="submit">Guardar nota</button>
    </form>

    <p><a href="/index.php">Volver al listado</a></p>
</body>

</html>