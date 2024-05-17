<?php
    // Incluir archivo de conexión
    include 'php/conexion_be.php';

    // Verificar conexión
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Consulta SQL
        $sql = "SELECT
        salon.id,
        salon.grado,
        salon.grupo,
        horarios.id,
        horarios.dia,
        horarios.HoraIni,
        horarios.HoraFin,
        asignatura.nombre
    FROM
        salon
    JOIN
        horarios
    ON
        salon.id = horarios.id_sal
    JOIN
        asignatura
    ON
    horarios.id_asi = asignatura.id";

    // Ejecutar consulta
    $result = $conexion->query($sql);


    // Verificar si la consulta fue exitosa
    if ($result === false) {
        echo "Error en la consulta: " . $conexion->error;
    } else {
        // Generar la estructura de la tabla HTML
        echo "<table>
                <tr>
                    <th>Materia</th>
                    <th>Clave</th>
                    <th>Día</th>
                    <th>Hora de Inicio</th>
                    <th>Hora de Fin</th>
                </tr>";

        // Mostrar resultados en la tabla
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                print_r(json_encode ($row));
            }
        } else {
            echo "<tr><td colspan='5' class='no-result'>.</td></tr>";
        }


    }

    // Cerrar conexión
    $conexion->close();
    ?>
