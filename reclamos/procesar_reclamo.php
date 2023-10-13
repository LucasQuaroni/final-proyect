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

// Verifica si el formulario se envió y si se proporcionó el DNI
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["dni_cliente"])) {
    $dni_cliente = $_POST["dni_cliente"];

    // Aquí puedes procesar los datos del formulario de registro de reclamo
    // Asegúrate de verificar y validar los datos del formulario y ejecutar las consultas SQL necesarias.

    // Por ejemplo:
    $modelo_artefacto = $_POST["modelo_artefacto"];
    $numero_serie = $_POST["numero_serie"];
    $en_garantia = isset($_POST["en_garantia"]) ? 1 : 0;
    $problema_producto = $_POST["problema_producto"];

    // Inserta los datos del reclamo en la base de datos (reemplaza con tu consulta SQL)
    $sql = "INSERT INTO reclamos (dni, modelo_artefacto, numero_serie, en_garantia, problema_producto) VALUES ('$dni_cliente', '$modelo_artefacto', '$numero_serie', $en_garantia, '$problema_producto')";

    if ($conn->query($sql) === TRUE) {
        // El reclamo se registró con éxito
        echo "Reclamo registrado con éxito. Gracias.";
    } else {
        echo "Error al registrar el reclamo: " . $conn->error;
    }
}

// Cierra la conexión a la base de datos
$conn->close();
?>
