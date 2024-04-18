<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion_be.php';

// Verificar si se recibió un ID de docente
if (isset($_POST['id'])) {
    // Obtener el ID del docente
    $id = $_POST['id'];

    // Crear la consulta preparada para eliminar el docente
    $query = "DELETE FROM salon WHERE id = ?";

    // Preparar la consulta
    $stmt = mysqli_prepare($conexion, $query);

    // Vincular parámetros y ejecutar la consulta
    mysqli_stmt_bind_param($stmt, 'i', $id);
    if (mysqli_stmt_execute($stmt)) {
        echo "salon eliminado correctamente";
    } else {
        echo "Error al eliminar el salon: " . mysqli_stmt_error($stmt);
    }

    // Cerrar el statement
    mysqli_stmt_close($stmt);
} else {
    echo "Error: ID de salon no proporcionado";
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>


