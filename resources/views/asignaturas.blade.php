<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignaturas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Agrega el enlace para Font Awesome -->
    <link rel="stylesheet" href="css/asig.css">
    <script src="js/scriptAsignatura.js"></script>

    @include('principal')

</head>

<body>

    <div style="float:left;">
        <ul class="button-list">
            <li><a href="#modal" class="open-modal">Agregar asignatura</a></li>

        </ul>
    </div>

    <h2 style="text-align: center;">Tabla de Asignaturas</h2>
    <table class="asignatura-table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Clave</th>
                <th>Horas Semana</th>
                <th>Acciones</th>
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

                <label for="Clave">Clave:</label>
                <input type="text" id="Clave" name="Clave" class="modal-input" required><br>

                <label for="HoraSemana">Horas a la semana:</label>
                <input type="text" id="HoraSemana" name="HoraSemana" class="modal-input" required><br>

                <input type="submit" value="Guardar" class="modal-button">
            </form>
        </div>
    </div>


    <div id="modal-actualizar" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close-modal" onclick="closeActualizarModal()">&times;</span>
            <h2 class="modal-title">Actualizar asignatura</h2>
            <form id="form-actualizar-asignatura" method="post" action="php/actualizar_asig_be.php">
                <label for="nombre_actualizar">Nombre:</label>
                <input type="text" id="nombre_actualizar" name="nombre" class="modal-input" required><br>

                <label for="Clave_actualizar">Clave:</label>
                <input type="text" id="Clave_actualizar" name="Clave" class="modal-input" required><br>

                <label for="HoraSemana_actualizar">Horas a la semana:</label>
                <input type="text" id="HoraSemana_actualizar" name="HoraSemana" class="modal-input" required><br>

                <input type="hidden" id="id_asignatura_actualizar" name="id">
                <input type="submit" value="Actualizar" class="modal-button">
            </form>
        </div>
    </div>




      <!-- Scripts  -->
      <script>
        // Script para abrir y cerrar la ventana modal
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

        // Función para cargar los datos de la tabla al cargar la página
        window.addEventListener('load', function () {
            cargarDatosTabla();
        });

        // Función para abrir el modal de actualización y cargar los datos
        function openActualizarModal(id) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var asignatura = JSON.parse(xhr.responseText);
                        // Llenar el formulario del modal con los datos de la asignatura
                        document.getElementById('nombre_actualizar').value = asignatura.nombre;
                        document.getElementById('Clave_actualizar').value = asignatura.Clave;
                        document.getElementById('HoraSemana_actualizar').value = asignatura.HoraSemana;
                        document.getElementById('id_asignatura_actualizar').value = asignatura.id;
                        // Mostrar el modal de actualización
                        document.getElementById('modal-actualizar').style.display = 'block';
                    } else {
                        alert('Error al obtener los datos de la asignatura');
                    }
                }
            };
            xhr.open('GET', 'php/obtener_asig_por_id.php?id=' + id, true);
            xhr.send();
        }

        // Función para cerrar el modal de actualización
        function closeActualizarModal() {
            document.getElementById('modal-actualizar').style.display = 'none';
        }

        // Evento submit del formulario de agregar asignatura
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

        // Función para cargar los datos de la tabla de asignaturas
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

        // Función para actualizar la tabla de asignaturas
        function actualizarTabla(data) {
            var tablaBody = document.getElementById('asignaturas-body');
            tablaBody.innerHTML = '';

            data.forEach(function (asignatura) {
                var newRow = document.createElement('tr');
                newRow.innerHTML =
                    `<td>${asignatura.nombre}</td>
                     <td>${asignatura.Clave}</td>
                     <td>${asignatura.HoraSemana}</td>
                     <td><button onclick="eliminarAsignatura(${asignatura.id})">Eliminar</button>
                        <button onclick="openActualizarModal(${asignatura.id})">Actualizar</button></td>
                     `; // Botón de eliminar

                tablaBody.appendChild(newRow);
            });
        }

        // Función para eliminar una asignatura
        function eliminarAsignatura(id) {
            var confirmar = confirm('¿Estás seguro de que deseas eliminar esta asignatura?');
            if (confirmar) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            alert(xhr.responseText);
                            cargarDatosTabla(); // Actualiza la tabla después de eliminar
                        } else {
                            alert('Error al eliminar la asignatura');
                        }
                    }
                };
                xhr.open('POST', 'php/eliminar_asig_be.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('id=' + id); // Envía el ID de la asignatura a eliminar
            }
        }

        // Evento submit del formulario de actualización de asignatura
        document.getElementById('form-actualizar-asignatura').addEventListener('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(this);

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        alert(xhr.responseText);
                        document.getElementById('modal-actualizar').style.display = 'none';
                        window.location.reload(); // Recargar la página para actualizar la tabla
                    } else {
                        alert('Error al actualizar la asignatura');
                    }
                }
            };
            xhr.open('POST', 'php/actualizar_asig_be.php', true);
            xhr.send(formData);
        });

    </script>
</body>

</html>
