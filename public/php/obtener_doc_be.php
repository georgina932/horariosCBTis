<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion_be.php';

// Realizar la consulta para obtener los datos de los docentes
$query = "SELECT id, nombre, clave, carga, descarga, asignadas, entrada, salida FROM docentes";
$resultado = mysqli_query($conexion, $query);

// Verificar si se obtuvieron resultados
if ($resultado->num_rows > 0) {
    // Array para almacenar los datos de los docentes
    $docentes = array();

    // Obtener datos de cada fila y almacenarlos en el array
    while ($row = $resultado->fetch_assoc()) {
        $docente = array(
            'id' => $row['id'],
            'nombre' => $row['nombre'],
            'clave' => $row['clave'],
            'carga' => $row['carga'],
            'descarga' => $row['descarga'],
            'asignadas' => $row['asignadas'],
            'entrada' => $row['entrada'],
            'salida' => $row['salida']
        );

        // Agregar el docente al array
        array_push($docentes, $docente);
    }

    // Convertir el array a formato JSON y enviarlo
    echo json_encode($docentes);
} else {
    echo "0 resultados";
}

// Liberar el resultado y cerrar la conexión
mysqli_free_result($resultado);
mysqli_close($conexion);
?>
