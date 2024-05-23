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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <!-- Agrega el enlace para Font Awesome -->
    @include('principal')

    <!-- Estilos CSS para el modal -->
   <style>
        .modal {
            padding: 150px;
            z-index: 1000;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.9);
        }

.modal-content {
    background-color: #fff; /* Color de fondo blanco */
    border: 1px solid #888;
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
                padding: 10px;
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
            <tbody >
                <!-- Aquí se insertarán las filas de la tabla -->
            </tbody>
        </table>
    <br>
        <button id="repor">Generar reporte</button>
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

        function modalHorario(id) {
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
            var modal = document.getElementById('modal-horario');
    modal.style.display = 'block';

    // Agregar evento al botón de generar reporte dentro del modal
    document.getElementById('repor').addEventListener('click', function () {
        generarReportePDF();
    });

            };
            function generarReportePDF() {
    var jsPDF = window.jspdf.jsPDF;
    var doc = new jsPDF();

    // Obtener la tabla del modal
    var table = document.getElementById('horario');

    // Variables para el tamaño de la tabla y las celdas
    var tableWidth = table.clientWidth;
    var tableHeight = table.clientHeight;

    // Configuración inicial para el posicionamiento y el formato
    var xPos = 10;
    var yPos = 10;
    var cellPadding = 2; // Espacio interno en las celdas
    var fontSize = 35; // Tamaño de fuente aumentado

    // Calcular el ancho disponible para la tabla en el PDF
    var availableWidth = doc.internal.pageSize.width - (xPos * 2); // Restamos los márgenes izquierdo y derecho

    // Calcular el factor de escala para ajustar el tamaño de la tabla al ancho disponible
    var scale = availableWidth / tableWidth;

    // Calcular el nuevo tamaño de fuente y el espaciado entre celdas
    fontSize *= scale;
    cellPadding *= scale;

    // Establecer la nueva configuración de fuente y espaciado
    doc.setFontSize(fontSize);
    doc.setLineWidth(0.1); // Grosor de línea para los bordes

    // Estilo para el título
    doc.setFont('times', 'bold');
    doc.setTextColor(0, 0, 0); // Color rojo para el título

    // Agregar título
    doc.text("Horario del Grupo", xPos, yPos);
    yPos += fontSize + cellPadding * 2; // Ajustar posición vertical después del título

    // Restablecer estilo para la tabla
    doc.setFont('helvetica', 'normal');
    doc.setTextColor(0, 0, 0); // Color negro para el contenido de la tabla

    // Recorrer cada fila de la tabla
    for (var i = 0; i < table.rows.length; i++) {
        var row = table.rows[i];

        // Recorrer cada celda de la fila
        for (var j = 0; j < row.cells.length; j++) {
            var cell = row.cells[j];

            // Calcular el ancho de la celda y ajustar el texto si es necesario
            var cellWidth = cell.clientWidth * scale - (cellPadding * 2);
            var cellText = doc.splitTextToSize(cell.innerText, cellWidth);

            // Agregar bordes a la celda
            doc.rect(xPos, yPos, cell.clientWidth * scale, fontSize + (cellPadding * 2), 'S'); // 'S' significa solo bordes

            // Agregar el contenido de la celda al PDF con formato
            doc.text(xPos + cellPadding, yPos + cellPadding + fontSize, cellText); // Ajustar posición vertical para que coincida con el texto en el modal

            // Mover la posición en el PDF para la siguiente celda
            xPos += cell.clientWidth * scale; // No agregamos margen aquí para que los bordes se superpongan
        }

        // Restablecer la posición en el eje X y avanzar en el eje Y para la siguiente fila
        xPos = 10;
        yPos += fontSize + (cellPadding * 2); // Ajustar el espacio vertical para que coincida con el texto en el modal
    }

    // Guardar el PDF
    doc.save('reporte_horario.pdf');
}

    </script>
</body>

</html>
