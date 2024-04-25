<?php
include 'conexion_be.php';

// Verificar si el formulario se envió correctamente
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    // Verificar si todos los campos esperados están presentes en $_POST
    if (isset($_POST['Nombre'], $_POST['Correo'], $_POST['Usuario'], $_POST['Contrasena'])) {
        // Obtener los datos del formulario
        $nombre = $_POST['Nombre'];
        $correo = $_POST['Correo'];
        $usuario = $_POST['Usuario'];
        $contrasena = $_POST['Contrasena'];

        // Verificar si el usuario ya está registrado
        $query_verificar = "SELECT * FROM usuarios WHERE Usuario = ?";
        $statement_verificar = mysqli_prepare($conexion, $query_verificar);
        mysqli_stmt_bind_param($statement_verificar, "s", $usuario);
        mysqli_stmt_execute($statement_verificar);
        mysqli_stmt_store_result($statement_verificar);

        // Si el usuario ya está registrado, mostrar un mensaje y salir del script
        if (mysqli_stmt_num_rows($statement_verificar) > 0) {

           echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                var mensaje = "El usuario ya está registrado";
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


            exit();
        }

        // Preparar la consulta SQL para insertar el nuevo usuario
        $query_insertar = "INSERT INTO usuarios (Nombre, Correo, Usuario, Contrasena)
                  VALUES (?, ?, ?, ?)";
        $statement_insertar = mysqli_prepare($conexion, $query_insertar);
        mysqli_stmt_bind_param($statement_insertar, "ssss", $nombre, $correo, $usuario, $contrasena);

        // Ejecutar la consulta para insertar el nuevo usuario
        $ejecutar_insertar = mysqli_stmt_execute($statement_insertar);

        if ($ejecutar_insertar) {
            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                var mensaje = "usuario registrado exitosamente";
                var rutaRedireccion = "../index.php";

                var estiloAlerta = "position: fixed; top: 20px; left: 50%; transform: translateX(-50%); background-color: #4CAF50; color: white; padding: 10px 20px; border-radius: 5px; font-size: 16px; z-index: 9999;";

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
        } else {
            // Mostrar un mensaje de error si la consulta falla
            echo '<script>alert("Error al registrar el usuario: ' . mysqli_error($conexion) . '"); window.location = "../index.php";</script>';
        }

        // Cerrar la declaración para insertar el usuario
        mysqli_stmt_close($statement_insertar);
    } else {
        // Si falta algún campo, muestra un mensaje de error
        echo '<script>alert("Error: Datos del formulario incompletos"); window.location = "../index.php";</script>';
    }
} else {
    // Si el formulario no se envió correctamente, redirige al usuario a la página principal
    header("Location: ../index.php");
    exit();
}

// Cerrar la declaración de verificación y la conexión a la base de datos
mysqli_stmt_close($statement_verificar);
mysqli_close($conexion);
?>


