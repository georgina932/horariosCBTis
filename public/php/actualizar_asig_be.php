<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion_be.php';

// Verificar si se recibieron los datos del formulario y el ID de la asignatura
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $clave = $_POST['Clave'];
    $horaSemana = $_POST['HoraSemana'];

    // Preparar la consulta SQL para actualizar la asignatura
    $sql = "UPDATE asignatura SET nombre=?, Clave=?, HoraSemana=? WHERE id=?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo "Error en la preparación de la consulta.";
    } else {
        $stmt->bind_param("sssi", $nombre, $clave, $horaSemana, $id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "¡Asignatura actualizada correctamente!";
        } else {
            echo "Error al actualizar la asignatura: " . $stmt->error;
        }

        // Cerrar la declaración preparada
        $stmt->close();
    }
} else {
    // Si no se reciben los datos correctamente, mostrar un mensaje de error
    echo "Error: No se recibieron los datos correctamente.";
}

// Cerrar la conexión
$conn->close();
?>
