<?php
include 'conexion_be.php';
// Verificar si se recibió el ID de la asignatura desde el formulario
if (isset($_POST['asignatura'])) {
    $idAsignaturaSeleccionada = $_POST['asignatura'];
    $idDocente = $_POST['docente'];
    $fecha = date("Y-m-d h:m");

    // Preparar la consulta SQL
    $query = "INSERT INTO relacion (id_doc, id_asi, fecha)
    VALUES (?, ?, ?)";

    // Preparar la declaración y vincular los parámetros
    $statement = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($statement, "iis", $idAsignaturaSeleccionada, $idDocente, $fecha);



    // Ejecutar la consulta
    $ejecutar = mysqli_stmt_execute($statement);

    $sql = "UPDATE asignatura SET  disponible=? WHERE id=$idAsignaturaSeleccionada";
    $stmt = $conexion->prepare($sql);
    $status = 0;
    $stmt->bind_param("i", $status);
    mysqli_stmt_execute($stmt);





    // Aquí puedes realizar las acciones que necesites con el ID de la asignatura seleccionada
    // Por ejemplo, guardar en la base de datos, redireccionar, mostrar información, etc.

    echo "Asignatura seleccionada con ID: " . $idAsignaturaSeleccionada;
} else {
    // Si no se recibió el ID de la asignatura, mostrar un mensaje de error
    echo "Error: No se recibió el ID de la asignatura";
}
?>
