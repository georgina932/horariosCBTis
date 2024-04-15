 // Función para cargar los datos actualizados en la tabla
 function cargarDatosTabla() {
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var responseData = JSON.parse(xhr.responseText);
                console.log(responseData);
                actualizarTabla1(responseData); // Llama a la función para actualizar la tabla con los datos obtenidos
            } else {
                alert('Error al cargar los datos de los docentes');
            }
        }
    };
    xhr.open('GET', 'php/obtener_doc_be.php', true); // Ruta al archivo PHP que obtiene los datos
    xhr.send();
}

function actualizarTabla1(data) {
    console.log(data)
    var tablaBody = document.querySelector('.docentes-table tbody');
    tablaBody.innerHTML = ''; // Vacía el contenido actual de la tabla

    // Itera sobre los datos y crea las filas de la tabla
    data.forEach(function(docente) {

        var newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>${docente.nombre}</td>
            <td>${docente.clave}</td>
            <td>${docente.cargadas}</td>
            <td>${docente.descarga}</td>
            <td>${docente.asignadas}</td>
            <td>${docente.entrada}</td>
            <td>${docente.salida}</td>
        `;
        tablaBody.appendChild(newRow);
    });
}

// Llama a la función para cargar los datos al cargar la página
window.addEventListener('load', cargarDatosTabla);


