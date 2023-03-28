<?php
session_start();
require_once 'db.php';

// Si el usuario no ha iniciado sesión, redirigir al formulario de inicio de sesión
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Si se recibió un envío POST con los datos actualizados del componente, actualizarlos en la base de datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];

    $sql = 'UPDATE components SET name=?, description=?, quantity=? WHERE id=?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $descripcion, $cantidad, $id]);

    // Redirigir al listado de componentes
    header('Location: tables.php');
    exit();
}

// Obtener el componente a editar según el ID recibido en la URL
$id = $_GET['id'];
$sql = 'SELECT * FROM components WHERE id=?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$componente = $stmt->fetch();

// Si no se encontró el componente, redirigir al listado de componentes
if (!$componente) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Inventario de componentes  - Editar componente</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

  <div class="container">
    <h2>Editar componente</h2>
    <form action="edit.php" method="post">
      <input type="hidden" name="id" value="<?php echo $componente['id']; ?>">

      <label for="nombre">Nombre:</label>
      <input type="text" id="nombre" name="nombre" value="<?php echo $componente[
          'name'
      ]; ?>" required>

      <label for="descripcion">Descripción:</label>
      <textarea id="descripcion" name="descripcion" rows="4" required><?php echo $componente[
          'description'
      ]; ?></textarea>

      <label for="cantidad">Cantidad:</label>
      <input type="number" id="cantidad" name="cantidad" min="0" value="<?php echo $componente[
          'quantity'
      ]; ?>" required>

      <input type="submit" value="Actualizar componente">
    </form>
    <p><a href="tables.php">&laquo; Volver al listado de componentes</a></p>
  </div>
</body>
</html>