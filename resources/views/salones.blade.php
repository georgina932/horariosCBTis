<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salones</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Agrega el enlace para Font Awesome -->
    <script src="js/scriptSalon.js"></script>

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
        .salon-table {
            margin: 20px auto; /* Centrar la tabla horizontalmente */
            border-collapse: collapse;
            width: 80%; /* Ancho de la tabla */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
            border-radius: 10px;
            overflow: hidden; /* Evitar desbordamiento de sombra */
            background-color: #fff; /* Fondo blanco */
        }

        .salon-table th,
        .salon-table td {
            border: 1px solid #ddd; /* Borde gris claro */
            padding: 12px;
            text-align: left;
        }

        .salon-table th {
            background-color: #f2f2f2; /* Fondo gris claro */
            color: #333; /* Texto oscuro */
            font-weight: bold;
        }

        .salon-table tbody tr:nth-child(even) {
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
                /* Estilos para los botones de actualizar y eliminar */
        .salon-table button {
            background-color: #9D2449; /* Color de fondo para los botones */
            color: #fff; /* Color del texto */
            border: none; /* Quita el borde */
            border-radius: 5px; /* Borde redondeado */
            padding: 8px 12px; /* Espaciado interno */
            margin-right: 5px; /* Margen derecho para separar los botones */
            cursor: pointer; /* Cambia el cursor al pasar sobre los botones */
        }

        .salon-table button:hover {
            background-color: #7A1E39; /* Color de fondo al pasar el mouse */
        }
    </style>
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

                <label for="grado_actualizar">Grado:</label>
                <input type="text" id="grado_actualizar" name="grado" class="modal-input" required><br>

                <label for="grupo_actualizar"> Grupo</label>
                <input type="text" id="grupo_actualizar" name="grupo" class="modal-input" required><br>

                <input type="hidden" id="id_salon_actualizar" name="id">
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
    // Función para abrir el modal de actualización y cargar los datos
    function openActualizarModal(id) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var asignatura = JSON.parse(xhr.responseText);
                    // Llenar el formulario del modal con los datos de la asignatura
                    document.getElementById('especialidad_actualizar').value = salon.especialidad;
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
</script>

    <!-- Script para la solicitud AJAX y actualización de la tabla -->
    <script>
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

        function cargarDatosTabla() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var responseData = JSON.parse(xhr.responseText);
                actualizarTabla(responseData);
            } else {
                alert('Error al cargar los datos del salon');
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
             <td>${salon.grado}</td>
             <td>${salon.grupo}</td>
             <td><button onclick="eliminarsalon(${salon.id})">Eliminar</button>
                <button onclick="openActualizarModal(${salon.id})">Actualizar</button></td>
             `; // Botón de eliminar

        tablaBody.appendChild(newRow);
    });
}

function eliminarSalon(id) {
    console.log('ID de salon a eliminar:', id);
    var confirmar = confirm('¿Estás seguro de que deseas eliminar este salon?');
    if (confirmar) {
        console.log();

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    alert(xhr.responseText);
                    cargarDatosTabla(); // Actualiza la tabla después de eliminar
                } else {
                    alert('Error al eliminar el salon');
                }
            }
        };
        xhr.open('POST', 'php/eliminar_sal_be.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('id=' + id); // Envía el ID de la asignatura a eliminar
    }
}
// Agregar evento submit al formulario una vez al cargar la página
document.getElementById('form-actualizar-salon').addEventListener('submit', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        var id = formData.get('id');

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Mostrar mensaje de actualización
                    alert(xhr.responseText);
                    // Cerrar el modal
                    document.getElementById('modal-actualizar1').style.display = 'none';
                    // Recargar la página para actualizar la tabla
                    window.location.reload();
                } else {
                    alert('Error al actualizar el salon');
                }
            }
        };
        xhr.open('POST', 'php/actualizar_sal_be.php', true);
        xhr.send(formData);
    });

    function actualizarSalon(id) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var asignatura = JSON.parse(xhr.responseText);
                    // Llenar el formulario del modal con los datos de la asignatura
                    document.getElementById('especialidad_actualizar').value = salon.especialidad;
                    document.getElementById('grado_actualizar').value =salon.grado;
                    document.getElementById('grupo_actualizar').value = salon.grupo;
                    document.getElementById('id_salon_actualizar').value = salon.id;
                    // Mostrar el modal de actualización
                    document.getElementById('modal-actualizar1').style.display = 'block';
                } else {
                    alert('Error al obtener los datos del salon');
                }
            }
        };
        xhr.open('GET', 'php/obtener_sal_por_id.php?id=' + id, true);
        xhr.send();
    }

    function closeActualizarModal() {
        document.getElementById('modal-actualizar1').style.display = 'none';
    }
    </script>
    <script>
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
