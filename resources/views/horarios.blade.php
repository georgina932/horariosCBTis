<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horarios</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        /* Estilos para el contenedor principal */
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }



        /* Estilos para el for  mulario */
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Estilos para el select */
        select {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            max-width: 300px;
        }

        /* Estilos para el botón */
        button {
            padding: 10px 20px;
            background-color: #229439;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #145028;
        }
    </style>
</head>
<body>
    @include('principal')

    <div class="container">
        <h2 style="text-align: center;color: #333; margin-bottom: 20px;">
            Selecciona un docente:</h2>
        <form action="php/procesar_seleccion_be.php" method="POST">
            <select name="docente" id="docentes-select">
                <?php include 'php/consultar_docentes_be.php'; ?>
            </select>
            <button type="submit"><i class="fas fa-check-circle"></i> Seleccionar</button>
        </form>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#docentes-select').on('change', function() {
                var docenteId = $(this).val();
                $.ajax({
                    url: 'php/consultar_sal_be.php',
                    method: 'POST',
                    data: { docente_id: docenteId },
                    success: function(response) {
                        $('#salones-container').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>

    <script src="js/scriptDocente.js"></script>
</body>
</html>
