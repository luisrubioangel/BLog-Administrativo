<?php
// Importar la conexión
require 'includes/app.php';
$db = conectarDB();

// Crear un email y password
$name="luis32";
$email = "l@l.com";
$password = "1234";

$passwordHash = password_hash($password, PASSWORD_BCRYPT);


// Query para crear el usuario
$query = " INSERT INTO user (user_email,user_password,user_name) VALUES ( '${email}', '${passwordHash}','${name}'); ";
echo $query;

// Agregarlo a la base de datos
mysqli_query($db, $query);

?>
<h1>hola</h1>