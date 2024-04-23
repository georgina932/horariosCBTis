<?php
// Verificar si se recibió el ID del docente desde el formulario
if (isset($_POST['docente'])) {
    $idDocenteSeleccionado = $_POST['docente'];

    // Aquí puedes realizar las acciones que necesites con el ID del docente seleccionado
    // Por ejemplo, guardar en la base de datos, redireccionar, mostrar información, etc.

    echo "Docente seleccionado con ID: " . $idDocenteSeleccionado;
} else {
    // Si no se recibió el ID del docente, mostrar un mensaje de error
    echo "Error: No se recibió el ID del docente";
}
?>
