<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horarios</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/hora.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            text-align: left;
        }
        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #f2f2f2;
        }
        .no-result {
            text-align: center;
            color: #888;
        }
    </style>
</head>
<body>
    <!-- Incluir el contenido principal -->
    @include('principal')

    <div class="container">
        <h2 style="text-align: center; color: #333; margin-bottom: 20px;">Selección:</h2>
        <!-- Formulario de selección de docente y asignatura -->
        <form id="form-seleccion" method="POST" action="php/procesar_se_asig_be.php">
            <!-- Select para seleccionar docente -->
            <select name="docente" id="docentes-select">
                <?php include 'php/consultar_docentes_be.php'; ?>
            </select>
            <!-- Select para seleccionar asignatura -->
            <select name="asignatura" id="asignaturas-select">
                <?php include 'php/consultar_asig_be.php'; ?>
            </select>
            <!-- Botón para realizar la asignación -->
            <button type="submit" id="btn-asignar"><i class="fas fa-check-circle"></i> Asignar</button>
        </form>
    </div>
    <!-- Tabla de horarios -->
    <h2 style="text-align: center; color: #333; margin-top: 20px;">Horarios:</h2>
    <div id="tabla-horarios">
        <?php
        // Incluir archivo de conexión
        include 'php/conexion_be.php';

        // Verificar conexión
        if ($conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        }

        // Consulta SQL
        $sql = "SELECT a.nombre AS materia, a.Clave, h.dia, h.HoraIni, h.HoraFin
                FROM asignatura a
                INNER JOIN horarios h ON a.id = h.id_asi
                INNER JOIN salon s ON h.id_sal = s.id  -- Asegúrate de que esta columna existe y es correcta
                WHERE s.id = 1
                ORDER BY h.dia, h.HoraIni
                LIMIT 0, 25";

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
                    echo "<tr>
                            <td>" . $row["materia"] . "</td>
                            <td>" . $row["Clave"] . "</td>
                            <td>" . $row["dia"] . "</td>
                            <td>" . $row["HoraIni"] . "</td>
                            <td>" . $row["HoraFin"] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='no-result'>No se encontraron resultados.</td></tr>";
            }

            echo "</table>";
        }

        // Cerrar conexión
        $conexion->close();
        ?>
    </div>
</body>
</html>
