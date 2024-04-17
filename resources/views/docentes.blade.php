<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inicio</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Agrega el enlace para Font Awesome -->
<script src="js/scriptDocente.js"></script>

@include('principal')

<style>
/* Estilos del encabezado */


/* Estilos de la tabla */
.docentes-table {
    margin: 20px auto; /* Centrar la tabla horizontalmente */
            border-collapse: collapse;
            width: 80%; /* Ancho de la tabla */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
            border-radius: 10px;
            overflow: hidden; /* Evitar desbordamiento de sombra */
            background-color: #fff; /* Fondo blanco */
}

.docentes-table th,
.docentes-table td {
    border: 1px solid #ddd; /* Borde gris claro */
    padding: 12px;
    text-align: left;
}

.docentes-table th {
    background-color: #f2f2f2; /* Fondo gris claro */
    color: #333; /* Texto oscuro */
    font-weight: bold;
}

.docentes-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

/* Estilos de los botones de lista */
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
  background-color: #f1d2d2; /* Color de fondo */
  padding: 20px;
  border-radius: 5px;
  z-index: 1000;
  font-family: Arial, sans-serif; /* Fuente para toda la ventana modal */
  width: 40%; /* Cambia el ancho según tu preferencia */
  max-width: 400px; /* Establece un ancho máximo si lo deseas */
}

.modal input[type="text"],
.modal input[type="email"],
.modal select,
.modal textarea {
  width: calc(100% - 10px); /* Ancho ajustado con padding */
  padding: 8px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-sizing: border-box; /* Incluir padding y border en el ancho */
}

.modal label {
  display: block;
  margin-bottom: 10px;
  font-size: 16px;
  font-weight: bold;
}

.modal input[type="submit"] {
  background-color: #9D2449;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  cursor: pointer;
}

.modal input[type="submit"]:hover {
  background-color: #7A1E39;
}
/* Estilos para cerrar la ventana modal */
.close-modal {
  position: absolute;
  top: 10px;
  right: 10px;
  cursor: pointer;
}
</style>
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
    </script>
<script>
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
</script>

    <!-- Script para la solicitud AJAX y actualización de la tabla -->
    <script>
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
7
                tablaBody.appendChild(newRow);
            });
        }

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

        function actualizarDocente(id) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var docente = JSON.parse(xhr.responseText);
                // Llenar el formulario del modal con los datos del docente
                document.getElementById('nombre_actualizar').value = docente.nombre;
                document.getElementById('clave_actualizar').value = docente.clave;
                document.getElementById('carga_actualizar').value = docente.carga;
                document.getElementById('descarga_actualizar').value = docente.descarga;
                document.getElementById('asignadas_actualizar').value = docente.asignadas;
                document.getElementById('entrada_actualizar').value = docente.entrada;
                document.getElementById('salida_actualizar').value = docente.salida;
                document.getElementById('id_docente_actualizar').value = docente.id;
                // Mostrar el modal de actualización
                document.getElementById('modal-actualizar').style.display = 'block';
            } else {
                alert('Error al obtener los datos del docente');
            }
        }
    };
    xhr.open('GET', 'ruta/hacia/obtener_doc_por_id.php?id=' + id, true);
    xhr.send();
}

function closeActualizarModal() {
    document.getElementById('modal-actualizar').style.display = 'none';
}

document.getElementById('form-actualizar-docente').addEventListener('submit', function (e) {
    e.preventDefault(); // Evita que se envíe el formulario de manera convencional

    var formData = new FormData(this); // Obtiene los datos del formulario
    var id = formData.get('id'); // Obtén el ID del docente si es necesario (si tienes un campo oculto 'id')

    // Cierra el modal de actualización
    document.getElementById('modal-actualizar').style.display = 'none';

    // Recarga la página actual para actualizar la tabla de docentes
    window.location.reload();
});



    </script>
</body>
</html>
