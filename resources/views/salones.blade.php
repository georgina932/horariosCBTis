<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salones</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Agrega el enlace para Font Awesome -->
    <script src="js/scriptSalon.js"></script>
    <link rel="stylesheet" href="css/sal.css">
    @include('principal')

</head>

<body>

    <div style="float:left;">
        <ul class="button-list">
            <li><a href="#modal" class="open-modal">Agregar salón</a></li>

        </ul>
    </div>

    <h2 style="text-align: center;">Tabla de Salones</h2>
    <table class="salon-table">
        <thead>
            <tr>
                <th>Especialidad</th>
                <th>clave</th>
                <th>Grado</th>
                <th>Grupo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="salon-body">

            <!-- Aquí se mostrarán los datos -->
        </tbody>
    </table>

    <!-- Ventana modal -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2 class="modal-title">Agregar salón</h2>
            <form id="form-salon" method="post" action="agregar_sal_be.php">
                <label for="especialidad">Especialidad:</label>
                <input type="text" id="especialidad" name="especialidad" class="modal-input" required><br>

                <label for="clave">clave</label>
                <input type="text" id="clave" name="clave" class="modal-input" required><br>

                <label for="grado">Grado:</label>
                <input type="text" id="grado" name="grado" class="modal-input" required><br>

                <label for="grupo">Grupo:</label>
                <input type="text" id="grupo" name="grupo" class="modal-input" required><br>

                <input type="submit" value="Guardar" class="modal-button">
            </form>
        </div>
    </div>


    <div id="modal-actualizar1" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close-modal" onclick="closeActualizarModal()">&times;</span>
            <h2 class="modal-title">Actualizar salón</h2>
            <form id="form-actualizar-salon" method="post" action="php/actualizar_sal_be.php">
                <label for="especialidad_actualizar">Especialidad:</label>
                <input type="text" id="especialidad_actualizar" name="especialidad" class="modal-input" required><br>

                <label for="clave_actualizar">Clave:</label>
                <input type="text" id="clave_actualizar" name="clave" class="modal-input" required><br>

                <label for="grado_actualizar">Grado:</label>
                <input type="text" id="grado_actualizar" name="grado" class="modal-input" required><br>

                <label for="grupo_actualizar"> Grupo</label>
                <input type="text" id="grupo_actualizar" name="grupo" class="modal-input" required><br>

                <input type="hidden" id="id_salon_actualizar" name="id">
                <input type="submit" value="Actualizar" class="modal-button">
            </form>
        </div>
    </div>




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

        // Función para abrir el modal de actualización y cargar los datos
        function openActualiModal(id) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var salon = JSON.parse(xhr.responseText);
                        // Llenar el formulario del modal con los datos de la asignatura
                        document.getElementById('especialidad_actualizar').value = salon.especialidad;
                        document.getElementById('clave_actualizar').value = salon.clave;
                        document.getElementById('grado_actualizar').value = salon.grado;
                        document.getElementById('grupo_actualizar').value = salon.grupo;
                        document.getElementById('id_salon_actualizar').value = salon.id;
                        // Mostrar el modal de actualización
                        document.getElementById('modal-actualizar1').style.display = 'block';
                    } else {
                        alert('Error al obtener los datos del salón');
                    }
                }
            };
            xhr.open('GET', 'php/obtener_sal_por_id.php?id=' + id, true);
            xhr.send();
        }

        // Función para cerrar el modal de actualización
        function closeActualizarModal() {
            document.getElementById('modal-actualizar1').style.display = 'none';
        }

        // Evento submit para agregar un nuevo salón
        document.getElementById('form-salon').addEventListener('submit', function (e) {
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
                        alert('Error al agregar un salón');
                    }
                }
            };
            xhr.open('POST', 'php/agregar_sal_be.php', true);
            xhr.send(formData);
        });

        // Función para cargar los datos de la tabla de salones
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

        // Función para actualizar la tabla de salones
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
                     <td><button onclick="eliminarSalon(${salon.id})">Eliminar</button>
                        <button onclick="openActualiModal(${salon.id})">Actualizar</button></td>
                     `; // Botón de eliminar

                tablaBody.appendChild(newRow);
            });
        }

        // Función para eliminar un salón
        function eliminarSalon(id) {
            var confirmar = confirm('¿Estás seguro de que deseas eliminar este salón?');
            if (confirmar) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            alert(xhr.responseText);
                            cargarDatosTabla(); // Actualiza la tabla después de eliminar
                        } else {
                            alert('Error al eliminar el salón');
                        }
                    }
                };
                xhr.open('POST', 'php/eliminar_sal_be.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('id=' + id); // Envía el ID del salón a eliminar
            }
        }

        // Evento submit para actualizar un salón
        document.getElementById('form-actualizar-salon').addEventListener('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            var id = formData.get('id');

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        alert(xhr.responseText);
                        document.getElementById('modal-actualizar1').style.display = 'none';
                        window.location.reload(); // Recarga la página para actualizar la tabla
                    } else {
                        alert('Error al actualizar el salón');
                    }
                }
            };
            xhr.open('POST', 'php/actualizar_sal_be.php', true);
            xhr.send(formData);
        });
    
        // Agregar evento submit al formulario una vez al cargar la página
        document.getElementById('form-actualizar-salon').addEventListener('submit', function (e) {
            e.preventDefault(); // Evita que se envíe el formulario de manera convencional

            var formData = new FormData(this); // Obtiene los datos del formulario
            var id = formData.get('id'); // Obtén el ID de la asignatura si es necesario (si tienes un campo oculto 'id')

            // Cierra el modal de actualización
            document.getElementById('modal-actualizar1').style.display = 'none';

            // Recarga la página actual para actualizar la tabla de asignaturas
            window.location.reload();
        });
    </script>
</body>

</html>
