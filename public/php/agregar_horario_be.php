<?php
include 'conexion_be.php';

// Verificar si el formulario se envió correctamente
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    // Verificar si todos los campos esperados están presentes en $_POST
    if (isset($_POST['dia'], $_POST['HoraIni'], $_POST['HoraFin'], $_POST['asignatura_id'])) {
        // Obtener los datos del formulario
        $dia = $_POST['dia'];
        $HoraIni = $_POST['HoraIni'];
        $HoraFin = $_POST['HoraFin'];
        $id_asi = $_POST['asignatura_id']; // Recibe el ID de la asignatura desde el formulario

        // Preparar la consulta SQL
        $query = "INSERT INTO horarios (dia, HoraIni, HoraFin, id_asi)
                  VALUES (?, ?, ?, ?)";

        // Preparar la declaración y vincular los parámetros
        $statement = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($statement, "sssi", $dia, $HoraIni, $HoraFin, $id_asi);

        // Ejecutar la consulta
        $ejecutar = mysqli_stmt_execute($statement);

        if ($ejecutar) {
            echo "Hora asignada exitosamente";
        } else {
            // Mostrar número de error de MySQL junto con el mensaje de error
            echo '<script>alert("Error al asignar: ' . mysqli_errno($conexion) . ' - ' . mysqli_error($conexion) . '"); window.location = "asignaturas.php";</script>';
        }

        // Cerrar la declaración
        mysqli_stmt_close($statement);
    } else {
        // Si falta algún campo, muestra un mensaje de error
        echo '<script>alert("Error: Datos del formulario incompletos"); window.location = "asignaturas.php";</script>';
    }
} else {
    // Si el formulario no se envió correctamente, redirige al usuario a la página principal
    header("Location: asignaturas.php");
    exit();
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
