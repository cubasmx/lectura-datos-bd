<?php
session_start(); // Iniciar sesión

// Destruir la sesión
session_unset(); 
session_destroy();

// Redirigir a index.php
header('Location: index.php');
exit();
?>
