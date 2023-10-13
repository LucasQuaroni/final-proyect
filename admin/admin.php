<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
  header("Location: ../login/login.html");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Servicio de PostVenta - FORNAX S.R.L</title>
  <link rel="stylesheet" href="admin-style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@500&family=Nunito:wght@500&family=Roboto+Condensed:ital@1&display=swap"
    rel="stylesheet" />
</head>

<body>
  <div class="header">
    <div class="logo">
      <a href="../home/home.html"><img src="../resources/logo-fornax-png.png" />
      </a>
    </div>
    <nav class="menu">
      <div class="nav-links">
        <a href="../login/logout.php">Cerrar sesión</a>
      </div>

    </nav>
  </div>
  <div class="container">
    <span class="title">MENU</span>
    <p class="desc">Login / Admin</p>
    <div class="dropdown">
      <div class="button-container">
        <a class="button" href="">RECLAMOS</a>
        <a class="button" href="">FLETES</a>
        <a class="button" href="">ESTADISTICAS</a>
      </div>
    </div>
  </div>
  <script src="admin-script.js"></script>
</body>

</html>