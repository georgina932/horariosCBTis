<?php
// Incluir el archivo de conexión a la base de datos
require_once 'conexion_be.php';

// Verificar si se recibieron los datos del formulario y el ID de la asignatura
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['Especialidad']; // Cambio: 'nombre' en minúsculas
    $clave = $_POST['grado'];   // Cambio: 'Clave' en mayúsculas
    $horaSemana = $_POST['grupo']; // Cambio: 'HoraSemana' en mayúsculas

    // Preparar la consulta SQL para actualizar la asignatura
    $sql = "UPDATE salon SET especialidad=?, grado=?, grupo=? WHERE id=?";
    $stmt = $conexion->prepare($sql);

    if ($stmt === false) {
        echo "Error en la preparación de la consulta.";
    } else {
        $stmt->bind_param("sssi", $especialidad, $grado, $grupo, $id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "salon actualizado ";
        } else {
            echo "Error al actualizar el salon: " . $stmt->error;
        }

        // Cerrar la declaración preparada
        $stmt->close();
    }
} else {
    // Si no se reciben los datos correctamente, mostrar un mensaje de error
    echo "Error: No se recibieron los datos correctamente.";
}

// Cerrar la conexión
$conexion->close();
?>
