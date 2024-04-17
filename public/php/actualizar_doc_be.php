<?php
// Incluir el archivo de conexión a la base de datos
require_once 'conexion_be.php';

// Verificar si se recibieron los datos del formulario y el ID del docente
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $clave = $_POST['clave']; // Corregido: 'clave' en minúsculas
    $carga = $_POST['carga']; // Corregido: 'carga' en minúsculas
    $descarga = $_POST['descarga']; // Corregido: 'descarga' en minúsculas
    $asignadas = $_POST['asignadas']; // Corregido: 'asignadas' en minúsculas
    $entrada = $_POST['entrada']; // Corregido: 'entrada' en minúsculas
    $salida = $_POST['salida']; // Corregido: 'salida' en minúsculas

    // Preparar la consulta SQL para actualizar el docente
    $sql = "UPDATE docentes SET nombre=?, clave=?, carga=?, descarga=?, asignadas=?, entrada=?, salida=? WHERE id=?";
    $stmt = $conexion->prepare($sql);

    if ($stmt === false) {
        echo "Error en la preparación de la consulta.";
    } else {
        $stmt->bind_param("sssssssi", $nombre, $clave, $carga, $descarga, $asignadas, $entrada, $salida, $id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Docente actualizado correctamente.";
        } else {
            echo "Error al actualizar el docente: " . $stmt->error;
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

