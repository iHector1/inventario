<header>
  <nav>
    <ul>
      <?php if (isset($_SESSION['username'])): ?>
        <li><a href="tables.php">Componentes</a></li>
        <li><a href="add.php">Agregar componente</a></li>
        <li><a href="logout.php">Cerrar sesión</a></li>
      <?php else: ?>
        <li><a href="login.php">Iniciar sesión</a></li>
        <li><a href="register.php">Registrarse</a></li>
      <?php endif; ?>
    </ul>
  </nav>
</header>