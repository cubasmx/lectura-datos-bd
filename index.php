<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configuración de conexión
$host = 'localhost';
$user = 'u163464070_root';
$password = 'f8044A87b2';
$db = 'u163464070_ejemplo';


$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

// Insertar un nuevo usuario si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $contraseña = $_POST['contraseña'] ?? '';

    if ($nombre && $correo && $contraseña) {
        $contraseña_hash = password_hash($contraseña, PASSWORD_DEFAULT);
        $stmt = $conn->prepare('INSERT INTO usuarios (nombre, correo) VALUES (?, ?)');
        $stmt = $conn->prepare('INSERT INTO usuarios (nombre, correo, contraseña) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $nombre, $correo, $contraseña_hash);
        $stmt->execute();
        $stmt->close();
    }
}

// Consultar todos los usuarios
$result = $conn->query('SELECT * FROM usuarios');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
</head>
<body>
    <h1>Lista de Usuarios</h1>
    <ul>
        <?php while ($row = $result->fetch_assoc()): ?>
            <li><?php echo $row['nombre'] . ' - ' . $row['correo']; ?></li>
        <?php endwhile; ?>
    </ul>

    <h2>Agregar Usuario</h2>
    <form method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>
        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required>
        <br>
        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña" required>
        <br>
        <button type="submit">Registrar</button>
        <a href="login.php">
        <button type="button">Ir a Login</button>
        </a>
    </form>

</body>
</html>

<?php $conn->close(); ?>
