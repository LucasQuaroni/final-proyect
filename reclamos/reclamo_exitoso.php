<?php
// Iniciar la sesión para acceder a los datos del reclamo
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reclamo Exitoso!</title>
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@500&family=Nunito:wght@500&family=Roboto+Condensed:ital@1&display=swap"
    rel="stylesheet" />
</head>

<body>
  <div class="header">
    <div class="logo">
      <a href="../index.html"><img src="../resources/logo-fornax-png.png" /></a>
    </div>
  </div>
  <div class="container">

    <h1>Reclamo registrado con éxito!</h1>
    <div class="resumen">
      <p><b>Número de DNI:</b>
        <?php echo $_SESSION['dni_cliente']; ?>
      </p>
      <p><b>Modelo de artefacto:</b>
        <?php echo $_SESSION['modelo_artefacto']; ?>
      </p>
      <p><b>Número de serie:</b>
        <?php echo $_SESSION['numero_serie']; ?>
      </p>
      <p><b>¿Está en garantía?</b>
        <?php echo ($_SESSION['en_garantia'] ? "Sí" : "No"); ?>
      </p>
      <p><b>Problema del producto:</b>
        <?php echo $_SESSION['problema_producto']; ?>
      </p>
    </div>
    <a id="volver" href="../index.html">Volver al inicio</a>
  </div>

</body>

</html>