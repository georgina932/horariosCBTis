 // Función para  los datos actualizados en la tabla
 function cargarDatosTabla3() {
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
                var responseData = JSON.parse(xhr.responseText);
                console.log(responseData);
                actualizarTabla4(responseData); // Llama a la función para actualizar la tabla con los datos obtenidos
            } else {
                alert('Error al cargar los datos del salon');
            }
        }
    };
    xhr.open('GET', 'php/obtener_sal_be.php', true); // Ruta al archivo PHP que obtiene los datos
    xhr.send();
}

function actualizarTabla4(data) {
    console.log(data)
    var tablaBody = document.querySelector('.salon-table tbody');
    tablaBody.innerHTML = ''; // Vacía el contenido actual de la tabla

    // Itera sobre los datos y crea las filas de la tabla
    data.forEach(function(salones) {

        var newRow = document.createElement('tr');
        newRow.innerHTML =
         `
            <td>${salones.especialidad}</td>
            <td>${salones.grado}</td>
            <td>${salones.grupo}</td>
        `;
        tablaBody.appendChild(newRow);
    });
}

// Llama a la función para cargar los datos al cargar la página
window.addEventListener('load', cargarDatosTabla3);


