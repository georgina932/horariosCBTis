<?php
include 'conexion_be.php';

// Verificar si el formulario se envió correctamente
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    // Verificar si todos los campos esperados están presentes en $_POST
    if (isset($_POST['especialidad'], $_POST['clave'], $_POST['grado'], $_POST['grupo'])) {
        // Obtener los datos del formulario
        $especialidad = $_POST['especialidad'];
        $clave= $_POST['clave'];
        $grado= $_POST['grado'];
        $grupo = $_POST['grupo'];


        // Preparar la consulta SQL
        $query = "INSERT INTO salon (especialidad, clave, grado, grupo)
                  VALUES (?, ?, ?, ?)";

        // Preparar la declaración y vincular los parámetros
        $statement = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($statement, "ssss", $especialidad, $clave, $grado, $grupo);

        // Ejecutar la consulta
        $ejecutar = mysqli_stmt_execute($statement);

        if ($ejecutar) {
            echo "salon agregado exitosamente";
        } else {
            // Mostrar número de error de MySQL junto con el mensaje de error
            echo '<script>alert("Error al agregar un salon: ' . mysqli_errno($conexion) . ' - ' . mysqli_error($conexion) . '"); window.location = "salones.php";</script>';
        }

        // Cerrar la declaración
        mysqli_stmt_close($statement);
    } else {
        // Si falta algún campo, muestra un mensaje de error
        echo '<script>alert("Error: Datos del formulario incompletos"); window.location = "salones.php";</script>';
    }
} else {
    // Si el formulario no se envió correctamente, redirige al usuario a la página principal
    header("Location: salones.php");
    exit();
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
