<?php
include 'conexion_be.php';
// Verificar si se recibió el ID de la asignatura desde el formulario
if (isset($_POST['asignatura'])) {
    $idAsignaturaSeleccionada = $_POST['asignatura'];
    $idDocente = $_POST['docente'];
    $fecha = date("Y-m-d");


    // Preparar la consulta SQL
    $query = "INSERT INTO relacion (id_doc,id_asi,fecha)
    VALUES (?,?,?)";

    // Preparar la declaración y vincular los parámetros
    $statement = $conexion->prepare($query);




    if (true) {
        $statement->bind_param("iis",$idDocente, $idAsignaturaSeleccionada, $fecha);



    // Ejecutar la consulta
    $statement->execute();

    if ($ejecutar) {

    $sql = "UPDATE asignatura SET  disponible=? WHERE id=$idAsignaturaSeleccionada";
    $stmt = $conexion->prepare($sql);

    if ($stmt) {

    $status = 0;
    $stmt->bind_param("i", $status);
    mysqli_stmt_execute($stmt);


    echo '<script>
    window.onload = function() {
        alert("Asignatura asignada con éxito");
    }
        </script>';
            } else {
                echo "Error en la preparación de la consulta de actualización";
            }
        } else {
            echo "Error al ejecutar la consulta de inserción";
        }
    } else {
        echo "Error en la preparación de la consulta de inserción";
    }
} else {
    // Si no se recibió el ID de la asignatura o el ID del docente, mostrar un mensaje de error
    echo "Error: No se recibió el ID de la asignatura o el ID del docente";
}
?>
