<?php
// Conexión a la base de datos (reemplaza con tus propios detalles de conexión)
$servername = "localhost";
$username = "root";
$password = "";
$database = "fornaxpost";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verifica si el formulario se envió y si se proporcionó un DNI
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["dni_cliente"])) {
    $dni_cliente = $_POST["dni_cliente"];

    // Consulta a la base de datos para verificar la existencia del cliente
    $sql = "SELECT * FROM clientes WHERE dni = '$dni_cliente'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // El cliente ya está registrado, redirige a la página de reclamos
        header("Location: reclamo.php?dni=$dni_cliente");
    } else {
        // El cliente no está registrado, muestra un formulario para registrarlos
        // Puedes agregar campos adicionales para el registro aquí
        echo '<h2>Registro del Cliente</h2>';
        echo '<form method="post" action="procesar_registro_cliente.php">';
        echo '<div class="linea">';
        echo '<p>Nombre<span> *</span></p>';
        echo '<input type="text" name="nombre" required />';
        echo '</div>';
        echo '<div class="linea">';
        echo '<p>Apellido<span> *</span></p>';
        echo '<input type="text" name="apellido" required />';
        echo '</div>';
        echo '<input type="hidden" name="dni_cliente" value="' . $dni_cliente . '" />';
        echo '<button type="submit" name="submit">Registrar Cliente</button>';
        echo '</form>';
    }
}

// Cierra la conexión a la base de datos
$conn->close();
?>