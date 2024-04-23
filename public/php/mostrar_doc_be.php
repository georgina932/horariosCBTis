<?php
// Incluir el archivo de conexión a la base de datos
include 'Conexion_be.php';

// Consulta SQL para obtener los docentes
$sql = "SELECT * FROM docentes";
$result = $conn->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Mostrar lista de docentes
    echo "<h2>Lista de Docentes</h2>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . $row["nombre"] . "</li>"; // Aquí muestra el nombre del docente, puedes agregar más información si lo deseas
    }
    echo "</ul>";
} else {
    echo "No se encontraron docentes.";
}

// Cerrar conexión
$conn->close();
?>
