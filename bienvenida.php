<?php
$nombre = $_GET['nombre'] ?? 'Invitado';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
</head>
<body>
    <h1>Hola, <?php echo htmlspecialchars($nombre); ?>!</h1>
    <p>Bienvenido a tu espacio personalizado.</p>
</body>
</html>
