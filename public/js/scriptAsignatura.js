 // Función para  los datos actualizados en la tabla
 function cargarDatosTabla2() {
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
                var responseData = JSON.parse(xhr.responseText);
                console.log(responseData);
                actualizarTabla3(responseData); // Llama a la función para actualizar la tabla con los datos obtenidos
            } else {
                alert('Error al cargar los datos de la asignnatura');
            }
        }
    };
    xhr.open('GET', 'php/obtener_asig_be.php', true); // Ruta al archivo PHP que obtiene los datos
    xhr.send();
}

function actualizarTabla3(data) {
    console.log(data)
    var tablaBody = document.querySelector('.asignatura-table tbody');
    tablaBody.innerHTML = ''; // Vacía el contenido actual de la tabla

    // Itera sobre los datos y crea las filas de la tabla
    data.forEach(function(asignaturas) {

        var newRow = document.createElement('tr');
        newRow.innerHTML =
         `
            <td>${asignaturas.nombre}</td>
            <td>${asignaturas.Clave}</td>
            <td>${asignaturas.HoraSemana}</td>
        `;
        tablaBody.appendChild(newRow);
    });
}

// Llama a la función para cargar los datos al cargar la página
window.addEventListener('load', cargarDatosTabla2);


