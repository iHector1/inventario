<!DOCTYPE html>
<html>
<head>
  <title>Inventario - Inventario de Componentes </title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'header.php'; ?>
  <h1>Inventario de Componentes </h1>

  <?php
  session_start();

  if (!isset($_SESSION['username'])) {
      header('Location: index.php');
      exit();
  }

  require_once 'db.php';

  if (isset($_POST['add'])) {
      $name = $_POST['name'];
      $quantity = $_POST['quantity'];
      $description = $_POST['description'];

      $stmt = $pdo->prepare(
          'INSERT INTO components (name, quantity, description) VALUES (?, ?, ?)'
      );
      $stmt->execute([$name, $quantity, $description]);
  }

  if (isset($_POST['edit'])) {
      $id = $_POST['id'];
      $name = $_POST['name'];
      $quantity = $_POST['quantity'];
      $description = $_POST['description'];

      $stmt = $pdo->prepare(
          'UPDATE components SET name = ?, quantity = ?, description = ? WHERE id = ?'
      );
      $stmt->execute([$name, $quantity, $description, $id]);
  }

  if (isset($_POST['delete'])) {
      $id = $_POST['id'];

      $stmt = $pdo->prepare('DELETE FROM components WHERE id = ?');
      $stmt->execute([$id]);
  }

  $stmt = $pdo->query('SELECT * FROM components');
  $components = $stmt->fetchAll();
  ?>

  <p><a href="logout.php">Cerrar sesión</a></p>

  <h2>Agregar componente</h2>
  <form method="post">
    <label for="name">Nombre:</label>
    <input type="text" name="name" required>

    <label for="quantity">Cantidad:</label>
    <input type="number" name="quantity" required>

    <label for="description">Descripción:</label>
    <textarea name="description" required></textarea>

    <input type="submit" name="add" value="Agregar">
  </form>

  <h2>Inventario</h2>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Cantidad</th>
        <th>Descripción</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($components as $component): ?>
        <tr>
          <td><?php echo $component['id']; ?></td>
          <td><?php echo $component['name']; ?></td>
          <td><?php echo $component['quantity']; ?></td>
          <td><?php echo $component['description']; ?></td>
          <td>
            <form method="post">
              <input type="hidden" name="id" value="<?php echo $component[
                  'id'
              ]; ?>">
              <input type="submit" name="edit" value="Editar">
              <input type="submit" name="delete" value="Eliminar">
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <h2>Editar componente</h2>
  <form method="post">
    <label for="id">ID:</label>
    <label for="name">Nombre:</label>
<input type="text" name="name" required>

<label for="quantity">Cantidad:</label>
<input type="number" name="quantity" required>

<label for="description">Descripción:</label>
<textarea name="description" required></textarea>

<input type="submit" name="edit" value="Editar">
</form>
</body>
</html>