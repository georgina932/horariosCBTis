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

</head>
<body>
<!-- Tabla de horarios -->

    <h2 style="text-align: center;">crear horarios</h2>
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
                     <td><button onclick="verHorario(${salon.id})">Crear Horario</button></td>`;

                tablaBody.appendChild(newRow);
            });
        }
        
        function verHorario(id) {
            // Aquí puedes agregar la lógica para mostrar el horario del salón con el ID proporcionado
            alert('Mostrar horario del salón con ID: ' + id);
        }
    </script>


</div>
</body>
</html>
