<?php
$nombre = $_GET['nombre'] ?? 'Invitado';
session_start(); // Iniciar la sesión

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php'); // Si no está logueado, redirige a index.php
    exit();
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
    <!-- Botón de Cerrar Sesión -->
    <form action="cerrar_sesion.php" method="POST">
        <button type="submit">Cerrar Sesión</button>
    </form>

</body>
</html>
