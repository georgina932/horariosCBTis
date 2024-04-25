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
            echo  '<script>
            document.addEventListener("DOMContentLoaded", function() {
                var mensaje = "Usuario o contraseña incorrectos";
                var rutaRedireccion = "../index.php";

                var estiloAlerta = "position: fixed; top: 20px; left: 50%; transform: translateX(-50%); background-color: #f44336; color: white; padding: 10px 20px; border-radius: 5px; font-size: 16px; z-index: 9999;";

                var alerta = document.createElement("div");
                alerta.style.cssText = estiloAlerta;
                alerta.textContent = mensaje;
                document.body.appendChild(alerta);

                setTimeout(function() {
                    alerta.style.display = "none"; // Ocultar la alerta
                    window.location.href = rutaRedireccion; // Redireccionar después de ocultar la alerta
                },3000);
            });
        </script>';
        }
    } else {
        echo '<script>alert("Error: Datos del formulario incompletos"); window.location = "../index.php";</script>';
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>
