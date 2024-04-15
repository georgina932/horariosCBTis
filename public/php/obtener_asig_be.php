<?php

include 'conexion_be.php';


// Realizar la consulta para obtener los datos de los docentes
$query = "SELECT  id, nombre, Clave, HoraSemana FROM asignatura ";
$resultado = mysqli_query($conexion, $query);
if ($resultado->num_rows > 0) {
    // Array para almacenar los datos de los docentes
    $asignaturas = array();

    // Obtener datos de cada fila y almacenarlos en el array
    while ($row = $resultado->fetch_assoc()) {
      $asignatura = array(
        'id' => $row['id'],
        'nombre' => $row['nombre'],
        'Clave' => $row['Clave'],
        'HoraSemana' => $row['HoraSemana']
      );

      // Agregar  al array
      array_push($asignaturas, $asignatura);
    }

    // Convertir el array  a formato JSON y enviarlo
    echo json_encode($asignaturas);
  } else {
    echo "0 resultados";
  }

// Liberar el resultado y cerrar la conexión

mysqli_close($conexion);
?>
