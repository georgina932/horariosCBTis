<?php
include 'conexion_be.php';

// Verificar si el formulario se envió correctamente
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    // Verificar si todos los campos esperados están presentes en $_POST
    if (isset($_POST['nombre'], $_POST['clave'], $_POST['carga'], $_POST['descarga'], $_POST['asignadas'], $_POST['entrada'], $_POST['salida'])) {
        // Obtener los datos del formulario
        $nombre = $_POST['nombre'];
        $clave = $_POST['clave'];
        $carga = $_POST['carga'];
        $descarga = $_POST['descarga'];
        $asignadas = $_POST['asignadas'];
        $entrada = $_POST['entrada'];
        $salida = $_POST['salida'];

        // Preparar la consulta SQL
        $query = "INSERT INTO docentes (nombre, clave, carga, descarga, asignadas, entrada, salida)
                  VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Preparar la declaración y vincular los parámetros
        $statement = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($statement, "sssssss", $nombre, $clave, $carga, $descarga, $asignadas, $entrada, $salida);

        // Ejecutar la consulta
        $ejecutar = mysqli_stmt_execute($statement);

        if ($ejecutar) {
            echo "Docente agregado exitosamente";
        } else {
            // Mostrar número de error de MySQL junto con el mensaje de error
            echo '<script>alert("Error al agregar docente: ' . mysqli_errno($conexion) . ' - ' . mysqli_error($conexion) . '"); window.location = "docentes.php";</script>';
        }

        // Cerrar la declaración
        mysqli_stmt_close($statement);
    } else {
        // Si falta algún campo, muestra un mensaje de error
        echo '<script>alert("Error: Datos del formulario incompletos"); window.location = "docentes.php";</script>';
    }
} else {
    // Si el formulario no se envió correctamente, redirige al usuario a la página principal
    header("Location: docentes.php");
    exit();
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
