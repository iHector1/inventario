<!DOCTYPE html>
<html>
<head>
  <title>Regístrate - Inventario de Componentes </title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
<?php
session_start();
include 'header.php';
?>
<div class="card">
  <h1>Regístrate</h1>
  
  <?php
  if (isset($_SESSION['username'])) {
      header('Location: tables.php');
      exit();
  }

  if (isset($_POST['submit'])) {
      require_once 'db.php';
      $username = $_POST['username'];
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

      $stmt = $pdo->prepare(
          'INSERT INTO users (username, password) VALUES (?, ?)'
      );
      if ($stmt->execute([$username, $password])) {
          echo '<p>¡Te has registrado con éxito!</p>';
      } else {
          echo '<p>Ha habido un problema al registrar la cuenta.</p>';
      }
  }
  ?>

  <form method="post">
    <label for="username">Usuario:</label>
    <input type="text" name="username" required>
    <label for="password">Contraseña:</label>
<input type="password" name="password" required>

<input type="submit" name="submit" value="Regístrate">
</form>
</div>
</body>
</html>