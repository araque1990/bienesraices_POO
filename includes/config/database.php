<?php

function conectarDB(): mysqli
{

    $requiredVars = ['DB_HOST', 'DB_USER', 'DB_ROOT_PASSWORD', 'DB_NAME'];

    foreach ($requiredVars as $var) {
        if (!isset($_ENV[$var])) {
            echo "Error Crítico: La variable de entorno '$var' no está definida.";
            exit; // Matamos el proceso aquí.
        }
    }

    $host = $_ENV['DB_HOST'];
    $user = $_ENV['DB_USER'];
    $pass = $_ENV['DB_ROOT_PASSWORD'];
    $bd = $_ENV['DB_NAME'];

    $db = new mysqli($host, $user, $pass, $bd);

    if ($db->connect_error) {
        echo "Error no se pudo conectar: " . $db->connect_error;
        exit;
    }

    return $db;
}
