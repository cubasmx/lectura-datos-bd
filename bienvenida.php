<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = 'localhost';
$user = 'u163464070_root';
$password = 'f8044A87b2';
$db = 'u163464070_ejemplo';

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $contraseña = $_POST['contraseña'] ?? '';

    if ($nombre && $contraseña) {
        $stmt = $conn->prepare('SELECT contraseña FROM usuarios WHERE nombre = ?');
        $stmt->bind_param('s', $nombre);
        $stmt->execute();
        $stmt->bind_result($contraseña_hash);
        $stmt->fetch();
        $stmt->close();

        if ($contraseña_hash && password_verify($contraseña, $contraseña_hash)) {
            header('Location: bienvenida.php?nombre=' . urlencode($nombre));
            exit;
        } else {
            $mensaje = 'Nombre de usuario o contraseña incorrectos.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <?php if ($mensaje): ?>
        <p style="color: red;"><?php echo $mensaje; ?></p>
    <?php endif; ?>
    <form method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>
        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña" required>
        <br>
        <button type="submit">Ingresar</button>
    </form>
</body>
</html>
