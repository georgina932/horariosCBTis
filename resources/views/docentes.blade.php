<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Docentes</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Agrega el enlace para Font Awesome -->
<link rel="stylesheet" href="css/doce.css">
<script src="js/scriptDocente.js"></script>

@include('principal')


</head>
<body>
    <div style="float:left;">
        <ul class="button-list">
            <li><a href="#modal" class="open-modal" style="font-family: Arial, sans-serif;">Agregar docente</a></li>
        </ul>
    </div>

    <h2 style="font-family: Arial, sans-serif;" align="center">Tabla de Docentes</h2>

    <table class="docentes-table" style="font-family: Arial, sans-serif; font-size: 18px; margin: 0 auto;" align="center">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Clave</th>
                <th>Horas Cargadas</th>
                <th>Horas Descarga</th>
                <th>Horas Asig</th>
                <th>Entrada</th>
                <th>Salida</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="docentes-body">
            <!-- Aquí se mostrarán los datos de los docentes -->
        </tbody>
    </table>

    <!-- Ventana modal -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2>Agregar Docente</h2>
            <form id="form-docente" method="post" action="agregar_docente_be.php">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required><br>

                <label for="clave">Clave:</label>
                <input type="text" id="clave" name="clave" required><br>

                <label for="carga">Horas Cargadas:</label>
                <input type="text" id="carga" name="carga" required><br>

                <label for="descarga">Horas de Descarga:</label>
                <input type="text" id="descarga" name="descarga" required><br>

                <label for="asignadas">Horas Asignadas:</label>
                <input type="text" id="asignadas" name="asignadas" required><br>

                <label for="entrada">Hora de Entrada:</label>
                <input type="text" id="entrada" name="entrada" required><br>

                <label for="salida">Hora de Salida:</label>
                <input type="text" id="salida" name="salida" required><br>

                <input type="submit" value="Guardar">
            </form>
        </div>
    </div>

    <div id="modal-actu-Docente" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close-modal" onclick="closeActualModal()">&times;</span>
            <h2 class="modal-title">Actualizar docente</h2>
            <form id="form-actualizar-docente" method="post" action="php/actualizar_doc_be.php">
                <label for="nombre_actualizar1">Nombre:</label>
                <input type="text" id="nombre_actualizar1" name="nombre" class="modal-input" required><br>

                <label for="clave_actualizar1">Clave:</label>
                <input type="text" id="clave_actualizar1" name="clave" class="modal-input" required><br>

                <label for="carga_actualizar">Horas Cargadas:</label>
                <input type="text" id="carga_actualizar" name="carga" class="modal-input" required><br>

                <label for="descarga_actualizar">Horas de Descarga:</label>
                <input type="text" id="descarga_actualizar" name="descarga" class="modal-input" required><br>

                <label for="asignadas_actualizar">Horas Asignadas:</label>
                <input type="text" id="asignadas_actualizar" name="asignadas" class="modal-input" required><br>

                <label for="entrada_actualizar">Hora de Entrada:</label>
                <input type="text" id="entrada_actualizar" name="entrada" class="modal-input" required><br>

                <label for="salida_actualizar">Hora de Salida:</label>
                <input type="text" id="salida_actualizar" name="salida" class="modal-input" required><br>

                <input type="hidden" id="id_docente_actualizar" name="id">
                <input type="submit" value="Actualizar" class="modal-button">
            </form>
        </div>
    </div>

    <!-- Script para abrir y cerrar la ventana modal -->
    <script>
        // Función para abrir y cerrar la ventana modal
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

        // Función para abrir el modal de actualización y cargar los datos del docente
        function openActualModal(id) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var docente = JSON.parse(xhr.responseText);
                        // Llenar el formulario del modal con los datos del docente
                        document.getElementById('nombre_actualizar1').value = docente.nombre;
                        document.getElementById('clave_actualizar1').value = docente.clave;
                        document.getElementById('carga_actualizar').value = docente.carga;
                        document.getElementById('descarga_actualizar').value = docente.descarga;
                        document.getElementById('asignadas_actualizar').value = docente.asignadas;
                        document.getElementById('entrada_actualizar').value = docente.entrada;
                        document.getElementById('salida_actualizar').value = docente.salida;
                        document.getElementById('id_docente_actualizar').value = docente.id;
                        // Mostrar el modal de actualización
                        document.getElementById('modal-actu-Docente').style.display = 'block';
                    } else {
                        alert('Error al obtener los datos del docente');
                    }
                }
            };
            xhr.open('GET', 'php/obtener_doc_por_id.php?id=' + id, true);
            xhr.send();
        }

        // Función para cerrar el modal de actualización
        function closeActualizarModal() {
            document.getElementById('modal-actualizar').style.display = 'none';
        }

        // Evento submit para agregar un nuevo docente
        document.getElementById('form-docente').addEventListener('submit', function (e) {
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
                        alert('Error al agregar un docente');
                    }
                }
            };
            xhr.open('POST', 'php/agregar_doc_be.php', true);
            xhr.send(formData);
        });

        // Función para cargar los datos de la tabla de docentes
        function cargarDatosTabla() {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var responseData = JSON.parse(xhr.responseText);
                        actualizarTabla(responseData);
                    } else {
                        alert('Error al cargar los datos de los docentes');
                    }
                }
            };
            xhr.open('GET', 'php/obtener_doc_be.php', true);
            xhr.send();
        }

        // Función para actualizar la tabla de docentes
        function actualizarTabla(data) {
            var tablaBody = document.getElementById('docentes-body');
            tablaBody.innerHTML = '';

            data.forEach(function (docente) {
                var newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>${docente.nombre}</td>
                    <td>${docente.clave}</td>
                    <td>${docente.carga}</td>
                    <td>${docente.descarga}</td>
                    <td>${docente.asignadas}</td>
                    <td>${docente.entrada}</td>
                    <td>${docente.salida}</td>
                    <td><button onclick="eliminarDocente(${docente.id})">Eliminar</button>
                        <button onclick="openActualModal(${docente.id})">Actualizar</button></td>
                `; // Botón de eliminar y actualizar

                tablaBody.appendChild(newRow);
            });
        }

        // Función para eliminar un docente
        function eliminarDocente(id) {
            var confirmar = confirm('¿Estás seguro de que deseas eliminar este docente?');
            if (confirmar) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            alert(xhr.responseText);
                            cargarDatosTabla(); // Actualiza la tabla después de eliminar
                        } else {
                            alert('Error al eliminar el docente');
                        }
                    }
                };
                xhr.open('POST', 'php/eliminar_doc_be.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('id=' + id); // Envía el ID del docente a eliminar
            }
        }

        // Evento submit para actualizar un docente
        document.getElementById('form-actualizar-docente').addEventListener('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            var id = formData.get('id');

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        alert(xhr.responseText);
                        document.getElementById('modal-actu-Docente').style.display = 'none';
                        window.location.reload(); // Recarga la página para actualizar la tabla
                    } else {
                        alert('Error al actualizar el docente');
                    }
                }
            };
            xhr.open('POST', 'php/actualizar_doc_be.php', true);
            xhr.send(formData);
        });
    </script>
</body>
</html>
