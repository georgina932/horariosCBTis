<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    if (isset($_POST['Usuario'], $_POST['Contrasena'])) {
        $usuario = $_POST['Usuario'];
        $contrasena = $_POST['Contrasena'];

        // Verificar credenciales en la base de datos
        include 'conexion_be.php';
        $query = "SELECT * FROM usuarios WHERE Usuario = '$usuario' AND Contrasena = '$contrasena'";
        $resultado = mysqli_query($conexion, $query);
        $fila = mysqli_fetch_assoc($resultado);
        mysqli_free_result($resultado);
        mysqli_close($conexion);

        if ($fila) {
            // Credenciales válidas, iniciar sesión
            $_SESSION['usuario'] = $usuario;
            header("Location: /principal");
            exit();
        } else {
            echo '<script>alert("Credenciales incorrectas"); window.location = "../index.php";</script>';
        }
    } else {
        echo '<script>alert("Error: Datos del formulario incompletos"); window.location = "../index.php";</script>';
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>
