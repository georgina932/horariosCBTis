<?php
// Incluir el archivo de conexión a la base de datos
require_once 'conexion_be.php';

// Obtener el ID del docente desde la solicitud GET
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Verificar si se proporcionó un ID válido
if ($id !== null && is_numeric($id)) {
    // Consulta SQL para obtener los datos del docente
    $sql = "SELECT id, especialidad, grado, grupo, FROM salon WHERE id = ?";

    // Preparar la consulta
    $stmt = $conexion->prepare($sql);

    if ($stmt) {
        // Vincular el parámetro ID a la consulta
        $stmt->bind_param("i", $id);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado de la consulta
        $result = $stmt->get_result();

        // Verificar si se encontraron datos
        if ($result->num_rows > 0) {
            // Obtener los datos del docente como un array asociativo
            $row = $result->fetch_assoc();

            // Devolver los datos del docente en formato JSON
            echo json_encode($row);
        } else {
            // No se encontraron datos para el ID proporcionado
            http_response_code(404);
            echo json_encode(array('error' => 'salon no encotrado no encontrado'));
        }

        // Cerrar la consulta
        $stmt->close();
    } else {
        // Error al preparar la consulta
        http_response_code(500);
        echo json_encode(array('error' => 'Error interno del servidor'));
    }
} else {
    // El ID proporcionado no es válido
    http_response_code(400);
    echo json_encode(array('error' => 'ID de salon no válido'));
}

// Cerrar la conexión
$conexion->close();
?>
