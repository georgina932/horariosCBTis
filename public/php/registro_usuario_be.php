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

        // Preparar la consulta SQL
        $query = "INSERT INTO usuarios (Nombre, Correo, Usuario, Contrasena)
                  VALUES (?, ?, ?, ?)";

        // Preparar la declaración y vincular los parámetros
        $statement = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($statement, "ssss", $nombre, $correo, $usuario, $contrasena);

        // Ejecutar la consulta
        $ejecutar = mysqli_stmt_execute($statement);

        if ($ejecutar) {
            echo '<script>alert("Usuario registrado exitosamente"); window.location = "../index.php";</script>';
        } else {
            // Mostrar un mensaje de error si la consulta falla
            echo '<script>alert("Error al registrar el usuario: ' . mysqli_error($conexion) . '"); window.location = "../index.php";</script>';
        }

        // Cerrar la declaración
        mysqli_stmt_close($statement);
    } else {
        // Si falta algún campo, muestra un mensaje de error
        echo '<script>alert("Error: Datos del formulario incompletos"); window.location = "../index.php";</script>';
    }
} else {
    // Si el formulario no se envió correctamente, redirige al usuario a la página principal
    header("Location: ../index.php");
    exit();
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
