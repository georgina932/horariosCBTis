<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion_be.php';

// Consulta para obtener los docentes
$sql = "SELECT id, nombre FROM docentes";
$result = $conexion->query($sql);

// Crear la lista de docentes en formato HTML
$docentesOptions = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $docentesOptions .= "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
    }
} else {
    $docentesOptions = "<option value=''>No hay docentes disponibles</option>";
}

$conexion->close();

// Retornar la lista de docentes en formato HTML
echo $docentesOptions;
?>
