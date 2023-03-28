<?php
$dsn = 'mysql:host=localhost;dbname=inventario';
$username = 'root';
$password = '';

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    echo 'Ha ocurrido un error al conectar con la base de datos: ' . $e->getMessage();
    exit;
}