<?php
$conexion = mysqli_connect("localhost", "root", "", "empresa");
$usuario = mysqli_real_escape_string($conexion, $_POST['user']);
$contra = mysqli_real_escape_string($conexion, $_POST['pass']);

if ($usuario != "" && $contra != "") {
    $consulta = "SELECT * FROM usuario WHERE usuario='$usuario' AND contraseña='$contra'";
    $resultado = mysqli_query($conexion, $consulta);
    $filas = mysqli_num_rows($resultado);

    if ($filas > 0) {
        $consulta_perfil = "SELECT perfil FROM usuario WHERE usuario='$usuario' AND contraseña='$contra'";
        $resultado_perfil = mysqli_query($conexion, $consulta_perfil);
        $perfil = mysqli_fetch_assoc($resultado_perfil)['perfil'];

        if ($perfil == 'A') {
            header("location:../admin/admin.html");
        } elseif ($perfil == 'C') {
            header("location:../chofer/chofer.html");
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