<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignación</title>
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
</body>
</html>
