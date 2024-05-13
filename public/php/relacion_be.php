<?php
// Incluir archivo de conexión
include 'conexion_be.php';

// Consulta SQL
$sql = "SELECT a.nombre AS materia, a.Clave, h.dia, h.HoraIni, h.HoraFin
        FROM asignatura a
        INNER JOIN horarios h ON a.id = h.id_asi
        INNER JOIN salon s ON h.id_sal = s.id
        WHERE s.id = 1
        ORDER BY h.dia, h.HoraIni
        LIMIT 0, 25";

$result = $conn->query($sql);

// Mostrar resultados en una tabla HTML
if ($result->num_rows > 0) {
  echo "<table>
          <tr>
            <th>Materia</th>
            <th>Clave</th>
            <th>Día</th>
            <th>Hora de Inicio</th>
            <th>Hora de Fin</th>
          </tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>" . $row["materia"] . "</td>
            <td>" . $row["Clave"] . "</td>
            <td>" . $row["dia"] . "</td>
            <td>" . $row["HoraIni"] . "</td>
            <td>" . $row["HoraFin"] . "</td>
          </tr>";
  }
  echo "</table>";
} else {
  echo "No se encontraron resultados.";
}

// Cerrar conexión (si es necesario, dependiendo de cómo lo manejes en conexion_be.php)
$conn->close();
?>
