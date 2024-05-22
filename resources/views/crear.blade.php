<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horarios</title>
    <link rel="stylesheet" href="css/hora.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/sal.css">
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/horarios.js"></script>

    <!-- Agrega el enlace para Font Awesome -->
    @include('principal')

    <!-- Estilos CSS para el modal -->
    <style>
        /* Estilos para el modal */
        .modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 18;
    top: 20;
    width: 50%;
    height: 50%;
    overflow: auto;
    background-color: rgba(255, 255, 255, 0.9); /* Fondo blanco con opacidad 0.9 */
}

.modal-content {
    background-color: #fff; /* Color de fondo blanco */
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 600px; /* Ancho máximo del modal */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
    border-radius: 5px; /* Bordes redondeados */
}

.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid #000;
                padding: 8px;
                text-align: center;
            }
            th {
                background-color: #f2f2f2;
            }

    </style>
</head>

<body>
    <!-- Tabla de horarios -->
    <h2 style="text-align: center;">Crear Horarios</h2>
    <table class="salon-table">
        <thead>
            <tr>
                <th>Especialidad</th>
                <th>Clave</th>
                <th>Grado</th>
                <th>Grupo</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody id="salon-body">
            <!-- Aquí se mostrarán los datos -->
        </tbody>
    </table>

    <!-- Modal para mostrar el horario -->
    <div id="modal-horario" class="modal">
        <span class="close">&times;</span>

        <h1>Horario del grupo </h1>
        <table id="horario">
            <thead>
                <tr>
                    <th>Hora</th>
                    <th>Lunes</th>
                    <th>Martes</th>
                    <th>Miércoles</th>
                    <th>Jueves</th>
                    <th>Viernes</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se insertarán las filas de la tabla -->
            </tbody>
        </table>

    </div>

    <script>
        window.addEventListener('load', function () {
            cargarDatosTabla();
        });

        function cargarDatosTabla() {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var responseData = JSON.parse(xhr.responseText);
                        actualizarTabla(responseData);
                    } else {
                        alert('Error al cargar los datos del salón');
                    }
                }
            };
            xhr.open('GET', 'php/obtener_sal_be.php', true);
            xhr.send();
        }

        function actualizarTabla(data) {
            var tablaBody = document.getElementById('salon-body');
            tablaBody.innerHTML = '';

            data.forEach(function (salon) {
                var newRow = document.createElement('tr');
                newRow.innerHTML =
                    `<td>${salon.especialidad}</td>
                     <td>${salon.clave}</td>
                     <td>${salon.grado}</td>
                     <td>${salon.grupo}</td>
                     <td><button onclick="cargarHorario(${salon.id})">Crear Horario</button></td>`;

                tablaBody.appendChild(newRow);
            });
        }

        function cargarHorario(id) {
            // Aquí puedes agregar la lógica para cargar el horario del salón con el ID proporcionado
            var modal = document.getElementById('modal-horario');
            var modalContent = modal.querySelector('.modal-content');
            var closeBtn = modal.querySelector('.close');
            var modalContentPlaceholder = document.getElementById('modal-content-placeholder');



            // Mostrar el modal
            modal.style.display = 'block';

            // Cerrar el modal al hacer clic en la "x"
            closeBtn.onclick = function () {
                modal.style.display = 'none';
            };

            // Cerrar el modal al hacer clic fuera del contenido
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            };
        }
    </script>
</body>

</html>
