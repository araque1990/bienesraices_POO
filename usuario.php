<?php

require 'includes/app.php';
$db = conectarDB();


if (!isset($_ENV['ADMIN_EMAIL']) || !isset($_ENV['ADMIN_PASSWORD'])) {

    exit("Error Crítico: Las variables de entorno ADMIN_EMAIL o ADMIN_PASSWORD no están definidas.");
}

$email = $_ENV['ADMIN_EMAIL'];
$password = $_ENV['ADMIN_PASSWORD'];


$passwordHash = password_hash($password, PASSWORD_BCRYPT);


$query = "INSERT INTO usuarios (email, password) VALUES ('$email', '$passwordHash');";

$resultado = mysqli_query($db, $query);

if($resultado) {
    echo "Usuario creado correctamente (Datos leídos desde variables de entorno).";
} else {
    echo "Error: " . mysqli_error($db);
}