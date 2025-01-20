<?php
// Configuración de conexión
$host = 'localhost';
$user = 'u163464070_root'; // Cambia este usuario si es necesario
$password = 'f8044A87b2'; // Cambia este password si es necesario
$db = 'u163464070_ejemplo';

// Conexión a la base de datos
$conn = new mysqli($host, $user, $password, $db);

// Verificar conexión
if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

// Consultar el registro
$result = $conn->query('SELECT * FROM items LIMIT 1');

// Mostrar resultado
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo '<h1>' . $row['nombre'] . '</h1>';
    echo '<p>' . $row['descripcion'] . '</p>';
} else {
    echo 'No hay registros.';
}

// Cerrar conexión
$conn->close();
?>
