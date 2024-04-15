<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Agrega el enlace para Font Awesome -->
    <script src="js/scriptAsignatura.js"></script>

    @include('principal')
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        /* Estilos de la tabla */
        .asignatura-table {
            margin: 20px auto; /* Centrar la tabla horizontalmente */
            border-collapse: collapse;
            width: 80%; /* Ancho de la tabla */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
            border-radius: 10px;
            overflow: hidden; /* Evitar desbordamiento de sombra */
            background-color: #fff; /* Fondo blanco */
        }

        .asignatura-table th,
        .asignatura-table td {
            border: 1px solid #ddd; /* Borde gris claro */
            padding: 12px;
            text-align: left;
        }

        .asignatura-table th {
            background-color: #f2f2f2; /* Fondo gris claro */
            color: #333; /* Texto oscuro */
            font-weight: bold;
        }

        .asignatura-table tbody tr:nth-child(even) {
            background-color: #f9f9f9; /* Fondo gris muy claro */
        }

        /* Estilos para el botón de agregar */
        .button-list {
            list-style-type: none;
            padding: 0;
            text-align: center; /* Centrar elementos de la lista */
        }

        .button-list li {
            margin-bottom: 10px;
        }

        .button-list a {
            display: inline-block;
            background-color: #229439;
            color: white;
            text-decoration: none;
            margin-left: 20px;
            padding: 15px 30px;
            border-radius: 5px;
            transition: background-color 0.3s ease; /* Transición suave */
        }

        .button-list a:hover {
            background-color: #145028; /* Color de fondo al pasar el mouse */
        }

        /* Estilos para la ventana modal */
        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #d9cdcd;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Sombra suave */
            z-index: 1000;
            font-family: Arial, sans-serif;
            width: 80%; /* Ancho del modal */
            max-width: 400px; /* Ancho máximo del modal */
        }

        .modal-content {
            margin-bottom: 20px;
        }

        .close-modal {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            color: #9D2449;
            cursor: pointer;
        }

        .modal-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .modal-input {
            width: calc(100% - 10px);
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .modal-input:focus {
            outline: none;
            border-color: #9D2449;
        }

        .modal-button {
            background-color: #9D2449;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }

        .modal-button:hover {
            background-color: #7A1E39;
        }
    </style>
</head>

<body>

    <div style="float:left;">
        <ul class="button-list">
            <li><a href="#modal" class="open-modal">Agregar asignatura</a></li>

        </ul>
    </div>

    <h2 style="text-align: center;">Tabla de salones</h2>
    <table class="asignatura-table">
        <thead>
            <tr>
                <th>Especialidad</th>
                <th>grado</th>
            </tr>
        </thead>
        <tbody id="asignaturas-body">
            <!-- Aquí se mostrarán los datos -->
        </tbody>
    </table>

    <!-- Ventana modal -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2 class="modal-title">Agregar asignatura</h2>
            <form id="form-asignatura" method="post" action="agregar_asig_be.php">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="modal-input" required><br>

                <label for="clave">Clave:</label>
                <input type="text" id="Clave" name="Clave" class="modal-input" required><br>

                <label for="carga">Horas a la semana:</label>
                <input type="text" id="HoraSemana" name="HoraSemana" class="modal-input" required><br>

                <input type="submit" value="Guardar" class="modal-button">
            </form>
        </div>
    </div>

    <!-- Script para abrir y cerrar la ventana modal -->
    <script>
        const openModal = document.querySelector('.open-modal');
        const closeModal = document.querySelector('.close-modal');
        const modal = document.getElementById('modal');

        openModal.addEventListener('click', function () {
            modal.style.display = 'block';
        });

        closeModal.addEventListener('click', function () {
            modal.style.display = 'none';
        });

        window.addEventListener('click', function (event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    </script>

    <!-- Script para la solicitud AJAX y actualización de la tabla -->
    <script>
        document.getElementById('form-asignatura').addEventListener('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(this);

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        alert(xhr.responseText);
                        document.getElementById('modal').style.display = 'none';
                        cargarDatosTabla(); // Función para cargar los datos actualizados
                    } else {
                        alert('Error al agregar una asignatura');
                    }
                }
            };
            xhr.open('POST', 'php/agregar_asig_be.php', true);
            xhr.send(formData);
        });

        function cargarDatosTabla() {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var responseData = JSON.parse(xhr.responseText);
                        actualizarTabla(responseData);
                    } else {
                        alert('Error al cargar los datos de la asignatura');
                    }
                }
            };
            xhr.open('GET', 'php/obtener_asig_be.php', true);
            xhr.send();
        }

        function actualizarTabla(data) {
            var tablaBody = document.getElementById('asignaturas-body');
            tablaBody.innerHTML = '';

            data.forEach(function (asignatura) {
                var newRow = document.createElement('tr');
                newRow.innerHTML =
                    `<td>${asignatura.nombre}</td>
                     <td>${asignatura.Clave}</td>
                     <td>${asignatura.HoraSemana}</td>`;
                tablaBody.appendChild(newRow);
            });
        }
    </script>
</body>

</html>
