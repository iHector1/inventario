<!DOCTYPE html>
<html>
<head>
  <title>Inventario de Componentes </title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/index.css">

</head>
<body>
<?php
session_start();
include 'header.php';
?>
<div class="container">
		<div class="card">
			<h1>Inventario de Componentes </h1>
			<?php if (isset($_SESSION['username'])) {
       echo '<p>¡Bienvenido, ' . $_SESSION['username'] . '!</p>';
   } else {
       echo '<p>Por favor, inicia sesión o regístrate para acceder al inventario.</p>';
   } ?>
			<div class="buttons">
				<a href="login.php">Iniciar sesión</a>
				<a href="register.php">Registrarme</a>
			</div>
		</div>
	</div>
</body>
</html>