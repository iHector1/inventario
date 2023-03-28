<?php
session_start();
require_once 'db.php';
include 'header.php';
// Si el usuario no ha iniciado sesión, redirigir al formulario de inicio de sesión
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Si se recibió un envío POST con los datos del componente, insertarlos en la base de datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];

    $sql =
        'INSERT INTO components (name, description, quantity) VALUES (?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $descripcion, $cantidad]);

    // Redirigir al listado de componentes
    header('Location: tables.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Inventario de componentes  - Agregar componente</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="container">
    <h2>Agregar componente</h2>
    <form action="add.php" method="post">
      <label for="nombre">Nombre:</label>
      <input type="text" id="nombre" name="nombre" required>

      <label for="descripcion">Descripción:</label>
      <textarea id="descripcion" name="descripcion" rows="4" required></textarea>

      <label for="cantidad">Cantidad:</label>
      <input type="number" id="cantidad" name="cantidad" min="0" required>

      <input type="submit" value="Agregar componente">
    </form>
    <p><a href="tables.php">&laquo; Volver al listado de componentes</a></p>
  </div>
</body>
</html>