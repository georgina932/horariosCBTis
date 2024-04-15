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

<h2 style="font-family: Arial, sans-serif;  " align="center">Tabla de Docentes</h2>

<table class="docentes-table" style="font-family: Arial, sans-serif; font-size: 18px; margin: 0 auto;" align="center">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Clave</th>
      <th>Horas Cargadas</th>
      <th>Horas de Descarga</th>
      <th>Horas Asignadas</th>
      <th>Hora Entrada</th>
      <th>Hora Salida</th>
    </tr>
  </thead>
  <tbody>
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

  <!-- Script para abrir y cerrar la ventana modal -->
  <script>
    // Obtener elementos
    const openModal = document.querySelector('.open-modal');
    const closeModal = document.querySelector('.close-modal');
    const modal = document.getElementById('modal');

    // Abrir modal al hacer clic en el enlace
    openModal.addEventListener('click', function() {
      modal.style.display = 'block';
    });

    // Cerrar modal al hacer clic en el botón de cerrar
    closeModal.addEventListener('click', function() {
      modal.style.display = 'none';
    });

    // Cerrar modal al hacer clic fuera de él
    window.addEventListener('click', function(event) {
      if (event.target === modal) {
        modal.style.display = 'none';
      }
    });
  </script>

  <script>
    document.getElementById('form-docente').addEventListener('submit', function(e) {
      e.preventDefault(); // Evitar que el formulario se envíe de forma convencional

      // Obtener los datos del formulario
      var formData = new FormData(this);

      // Enviar los datos mediante AJAX al archivo PHP
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            // Mostrar mensaje de éxito o error
            alert(xhr.responseText);

            // Cerrar la ventana modal
            document.getElementById('modal').style.display = 'none';

            // Actualizar la tabla (aquí debes escribir el código para cargar los datos actualizados)
            cargarDatosTabla(); // Esta función debe cargar los datos actualizados en la tabla
          } else {
            alert('Error al agregar docente');
          }
        }
      };
      xhr.open('POST', 'php/agregar_doc_be.php', true);
      xhr.send(formData);
    });

    // Función para cargar los datos actualizados en la tabla (debes implementarla según tu estructura de datos y forma de cargar la tabla)
    function cargarDatosTabla() {
                    var xhr = new XMLHttpRequest();

                xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                    var responseData = JSON.parse(xhr.responseText);

                    console.log(xhr.responseText);


                    actualizarTabla(responseData); // Llama a la función para actualizar la tabla con los datos obtenidos
                    } else {
                    alert('Error al cargar los datos de los docentes');
                    }
                }
                };
                xhr.open('GET','php/obtener_doc_be.php', true); // Ruta al archivo PHP que obtiene los datos
                xhr.send();
    }
    function actualizarTabla(data) {
                var tablaBody = document.getElementById('docentes-body');
                tablaBody.innerHTML = ''; // Vacía el contenido actual de la tabla

                // Itera sobre los datos y crea las filas de la tabla
                data.forEach(function(docente) {
                var newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>${docente.nombre}</td>
                    <td>${docente.clave}</td>
                    <td>${docente.horasCargadas}</td>
                    <td>${docente.horasDescarga}</td>
                    <td>${docente.horasAsignadas}</td>
                    <td>${docente.horaEntrada}</td>
                    <td>${docente.horaSalida}</td>
                `;
                tablaBody.appendChild(newRow);
                });
  }
   
  </script>

  </body>
  </html>
