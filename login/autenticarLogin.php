<?php
session_start();

$conexion = mysqli_connect("localhost", "root", "", "fornaxpost");
$usuario = mysqli_real_escape_string($conexion, $_POST['user']);
$contra = mysqli_real_escape_string($conexion, $_POST['pass']);

if ($usuario != "" && $contra != "") {
    $consulta = "SELECT * FROM usuarios WHERE usuario='$usuario' AND contra='$contra'";
    $resultado = mysqli_query($conexion, $consulta);
    $filas = mysqli_num_rows($resultado);

    if ($filas > 0) {
        $consulta_rol = "SELECT rol FROM usuarios WHERE usuario='$usuario' AND contra='$contra'";
        $resultado_rol = mysqli_query($conexion, $consulta_rol);
        $rol = mysqli_fetch_assoc($resultado_rol)['rol'];

        // Inicia la sesión y establece la variable de sesión
        $_SESSION['usuario'] = $usuario;
        $_SESSION['rol'] = $rol;

        if ($rol == 'A') {
            header("Location: ../admin/admin.php");
            exit;
        } elseif ($rol == 'C') {
            header("Location: ../chofer/chofer.php");
            exit;
        } elseif ($rol == 'T') {
            header("Location: ../tecnico/tecnico.php");
            exit;
        } else {
            echo "Error en la autenticación";
        }
    } else {
        echo "Error en la autenticación";
    }
} else {
    echo "Los campos de Usuario y Contraseña no pueden estar vacíos";
}
?>
