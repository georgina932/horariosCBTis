<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion_be.php';

// Verificar la conexión a la base de datos
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta para obtener las asignaturas
$sql = "SELECT id, nombre FROM asignatura WHERE disponible = '1'";
$result = $conexion->query($sql);

// Verificar si la consulta fue exitosa y $result es un objeto
if ($result && $result->num_rows > 0) {
    // Crear la lista de asignaturas en formato HTML
    $asignaturasOptions = "";
    while ($row = $result->fetch_assoc()) {
        $asignaturasOptions .= "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
    }
    // Retornar la lista de asignaturas en formato HTML
    echo $asignaturasOptions;
} else {
    // Mostrar un mensaje de error si la consulta no devolvió resultados
    echo "No hay asignaturas disponibles";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
