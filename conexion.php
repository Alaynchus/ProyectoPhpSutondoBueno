<?php
$servername = "localhost:3330"; // Nombre del servidor
$username = "root"; // Nombre de usuario de la base de datos
$password = "pass"; // Contraseña de la base de datos
$dbname = "sutondo"; // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si hay errores en la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
else{
    // Consulta SQL para seleccionar los datos de la tabla
}

// Realizar operaciones en la base de datos...

// Cerrar la conexión

?>