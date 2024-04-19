<?php

include 'conexion_be.php';


// Realizar la consulta para obtener los datos de los docentes
$query = "SELECT  id, especialidad, clave, grado, grupo FROM salon";
$resultado = mysqli_query($conexion, $query);
if ($resultado->num_rows > 0) {
    // Array para almacenar los datos de los docentes
    $salones = array();

    // Obtener datos de cada fila y almacenarlos en el array
    while ($row = $resultado->fetch_assoc()) {
      $salon = array(
        'id' => $row['id'],
        'especialidad' => $row['especialidad'],
        'clave' => $row['clave'],
        'grado' => $row['grado'],
        'grupo' => $row['grupo']
      );

      // Agregar  al array
      array_push($salones, $salon);
    }

    // Convertir el array  a formato JSON y enviarlo
    echo json_encode($salones);
  } else {
    echo "0 resultados";
  }

// Liberar el resultado y cerrar la conexión

mysqli_close($conexion);
?>
