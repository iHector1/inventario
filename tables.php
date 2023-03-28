<?php
session_start();
require_once 'db.php';
//require_once '../utils.php';

// Si el usuario no ha iniciado sesión, redirigir al formulario de inicio de sesión
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Obtener la lista de componentes de la base de datos
$sql = 'SELECT * FROM components ORDER BY id ASC';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$componentes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Inventario de componentes </title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'header.php'; ?>
  <div class="container">
    <h2>Componentes</h2>
    <p><a href="add.php" class="agregar-btn">Agregar componente</a></p>
    <?php if (count($componentes) > 0): ?>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($componentes as $componente): ?>
            <tr>
              <td><?php echo $componente['id']; ?>
              </td>
              <td>
                <?php echo $componente['name']; ?>
              </td>
              <td>
                <?php echo $componente['description']; ?>
              </td>
              <td>
                <?php echo $componente['quantity']; ?>
              </td>
              <td>
  <a href="edit.php?id=<?php echo $componente[
      'id'
  ]; ?>" class="edit-btn">Editar</a>
  <a href="delete.php?id=<?php echo $componente[
      'id'
  ]; ?>" class="delete-btn">Eliminar</a>
</td>

            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p>No se encontraron componentes.</p>
    <?php endif; ?>
  </div>
</body>
</html>