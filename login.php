<!DOCTYPE html>
<html>
<head>
  <title>Iniciar sesión - Inventario de Componentes </title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/login.css">

</head>
<body>
<?php include 'header.php'; ?>
  <div class="card">
    <h1>Iniciar sesión</h1>
    
    <?php
    session_start();

    if (isset($_SESSION['username'])) {
        header('Location: tables.php');
        exit();
    }

    if (isset($_POST['submit'])) {
        require_once 'db.php';

        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            header('Location: tables.php');
            exit();
        } else {
            echo '<p>Usuario o contraseña incorrectos.</p>';
        }
    }
    ?>

    <form method="post">
      <label for="username">Usuario:</label>
      <input type="text" name="username" required>

      <label for="password">Contraseña:</label>
      <input type="password" name="password" required>

      <input type="submit" name="submit" value="Iniciar sesión">
    </form>
  </div>
</body>
</html>