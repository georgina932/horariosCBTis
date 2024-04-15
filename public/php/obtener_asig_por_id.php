<?php
include 'conexion_be.php';

// Verificar si se recibió el ID de la asignatura y validar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $clave = $_POST['Clave'];
    $horaSemana = $_POST['HoraSemana'];

    // Consulta SQL para actualizar la asignatura
    $sql = "UPDATE asignatura SET nombre=?, Clave=?, HoraSemana=? WHERE id=?";
    $stmt = $conexion->prepare($sql);

    if ($stmt) { // Verificar si la preparación de la consulta fue exitosa
        $stmt->bind_param("sssi", $nombre, $clave, $horaSemana, $id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "¡Asignatura actualizada correctamente!";
        } else {
            echo "Error al actualizar la asignatura: " . $stmt->error;
        }

        // Cerrar la declaración preparada
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta."; // Mostrar mensaje de error
    }

    // Cerrar la conexión
    $conexion->close();
} else {
    // Si no se recibieron los datos correctamente, mostrar un mensaje de error
    echo "Error: No se recibieron los datos correctamente.";
}
?>
