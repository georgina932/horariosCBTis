<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion_be.php';

// Verificar si se recibió un ID de asignatura
if (isset($_POST['id'])) {
    // Obtener el ID de la asignatura
    $id = $_POST['id'];

    // Crear la consulta preparada para eliminar la asignatura
    $query = "DELETE FROM docentes WHERE id = ?";

    // Preparar la consulta
    $stmt = mysqli_prepare($conexion, $query);

    // Vincular parámetros y ejecutar la consulta
    mysqli_stmt_bind_param($stmt, 'i', $id);
    if (mysqli_stmt_execute($stmt)) {
        echo "Docente eliminad0 correctamente";
    } else {
        echo "Error al eliminar el docente: " . mysqli_stmt_error($stmt);
    }

    // Cerrar el statement
    mysqli_stmt_close($stmt);
} else {
    echo "Error: ID de docente no proporcionado";
}


// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
