<?php
    // Incluir archivo de conexión
    include 'conexion_be.php';

    $idHorario = $_POST["id"];
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
    horarios.id_asi = asignatura.id
    WHERE
        salon.id = $idHorario";

    // Ejecutar consulta
    $result = $conexion->query($sql);


    // Verificar si la consulta fue exitosa
    if ($result === false) {
        echo "Error en la consulta: " . $conexion->error;
    } else {
        // Generar la estructura de la tabla HTML

        if ($result->num_rows > 0) {
            $dataHorario = array();

            while($row = $result->fetch_assoc()) {

                $dataHorario[] = $row;
            }

            echo json_encode($dataHorario);
        } else {
            echo "<tr><td colspan='5' class='no-result'>.</td></tr>";
        }


    }

    // Cerrar conexión
    $conexion->close();
    ?>
