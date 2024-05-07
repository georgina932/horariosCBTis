<?php
include 'conexion_be.php';

// Verificar si se recibió el ID de la asignatura desde el formulario
if (isset($_POST['asignatura']) && isset($_POST['docente'])) {
    $idAsignaturaSeleccionada = $_POST['asignatura'];
    $idDocente = $_POST['docente'];
    $fecha = date("Y-m-d");

    // Preparar la consulta SQL para insertar en la tabla 'relacion'
    $queryInsert = "INSERT INTO relacion (id_doc, id_asi, fecha) VALUES (?, ?, ?)";

    // Preparar la declaración y vincular los parámetros para la inserción
    $statementInsert = $conexion->prepare($queryInsert);
    $statementInsert->bind_param("iis", $idDocente, $idAsignaturaSeleccionada, $fecha);

    // Ejecutar la consulta de inserción
    if ($statementInsert->execute()) {
        // Consulta para actualizar el valor de 'disponible' en la tabla 'asignatura'
        $queryUpdate = "UPDATE asignatura SET disponible = 0 WHERE id = ?";
        $statementUpdate = $conexion->prepare($queryUpdate);
        $statementUpdate->bind_param("i", $idAsignaturaSeleccionada);

        // Ejecutar la consulta de actualización
        if ($statementUpdate->execute()) {
            echo '<script>
                    window.onload = function() {
                        alert("Asignatura asignada con éxito");
                    }
                </script>';
        } else {
            echo "Error al ejecutar la consulta de actualización";
        }
    } else {
        echo "Error al ejecutar la consulta de inserción";
    }

    // Cerrar la conexión
    $conexion->close();
} else {
    // Si no se recibió el ID de la asignatura o el ID del docente, mostrar un mensaje de error
    echo "Error: No se recibió el ID de la asignatura o el ID del docente";
}
?>
