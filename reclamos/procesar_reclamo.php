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
if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["dni_cliente"]) || isset($_POST["dni-nuevo"]))) {
    $dni_cliente = $_POST["dni_cliente"];

    // Aquí puedes procesar los datos del formulario de registro de reclamo
    // Asegúrate de verificar y validar los datos del formulario y ejecutar las consultas SQL necesarias.

    // Por ejemplo:
    $modelo_artefacto = $_POST["modelo"];
    $numero_serie = $_POST["serial"];
    $en_garantia = isset($_POST["garantia"]) ? 1 : 0;
    $problema_producto = $_POST["desc"];

    // Verificar si el artefacto ya existe en la base de datos
    $sql_select_artefacto = "SELECT serial FROM artefactos WHERE serial = '$numero_serie'";
    $result = $conn->query($sql_select_artefacto);

    if ($result->num_rows > 0) {
        // El artefacto ya existe, asignar el id del artefacto al reclamo
        $row = $result->fetch_assoc();
        $id_artefacto = $row["id"];
    } else {
        // El artefacto no existe, insertarlo en la base de datos
        $sql_insert_artefacto = "INSERT INTO artefactos (serial, modelo, garantia) VALUES ('$numero_serie', '$modelo_artefacto', '$en_garantia')";
        if ($conn->query($sql_insert_artefacto) === TRUE) {
            // Obtener el id del artefacto recién insertado
            $id_artefacto = $conn->insert_id;
        } else {
            echo "Error al insertar el artefacto: " . $conn->error;
            exit;
        }
    }

    // Obtener la fecha actual
    $fecha_reclamo = date("Y-m-d H:i:s");

    // Insertar los datos del reclamo en la tabla de reclamos
    $sql_insert_reclamo = "INSERT INTO reclamos (dni, fecha, serial, idadmin, descripcion, idestado)
                          VALUES ('$dni_cliente', '$fecha_reclamo', '$numero_serie', NULL, '$problema_producto', NULL)";

    if ($conn->query($sql_insert_reclamo) === TRUE) {
        // Los datos del reclamo se han registrado con éxito en la base de datos
        // Configurar las variables de sesión
        session_start();
        $_SESSION['dni_cliente'] = $dni_cliente;
        $_SESSION['modelo_artefacto'] = $modelo_artefacto;
        $_SESSION['numero_serie'] = $numero_serie;
        $_SESSION['en_garantia'] = $en_garantia;
        $_SESSION['problema_producto'] = $problema_producto;

        // Redirigir a la página de reclamo exitoso
        header("Location: reclamo_exitoso.php");
        exit;
    } else {
        echo "Error al registrar el reclamo: " . $conn->error;
    }
}

// Cierra la conexión a la base de datos
$conn->close();
?>