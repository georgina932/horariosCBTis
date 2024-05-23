let url = window.location.hostname;


function cargarHorario(id) {

    $("#horario tbody").empty();
    $.ajax({
        url:  "/php/servidor.be.php",
        dataType: "JSON",
        type: "POST",
        data: {id:id},
        success: function (data, status, xhr) {
            render(data)
        },
        error: function (xhr, status, error) {},
    });
}

// Crear una estructura de horarios
function render(json) {
    console.log(json)
    var grup = json[0].grado + " " + json[0].grupo;
    var schedule = { grupo: grup, dias: {} };

    // Agrupar los datos por días y horas
    json.forEach((item) => {
      var day = item.dia.toLowerCase();
      var timeRange = item.HoraIni+"-"+item.HoraFin;
      if (!schedule.dias[day]) {
        schedule.dias[day] = {};
      }
      if (!schedule.dias[day][timeRange]) {
        schedule.dias[day][timeRange] = [];
      }
      schedule.dias[day][timeRange].push(item.nombre);
    });

    // Mostrar el horario
    console.log(schedule);

    const diasSemana = ["lunes", "martes", "miércoles", "jueves", "viernes"];
    const horasDia = ["7-9", "9-11", "11-12", "12-2"];

    const tbody = document.querySelector("#horario tbody");

    // Crear filas para cada franja horaria
    horasDia.forEach((hora) => {
      const row = document.createElement("tr");
      const horaCell = document.createElement("td");
      horaCell.textContent = hora;
      row.appendChild(horaCell);

      diasSemana.forEach((dia) => {
        const cell = document.createElement("td");
        if (schedule.dias[dia] && schedule.dias[dia][hora]) {
          cell.textContent = schedule.dias[dia][hora].join(", ");
        }
        row.appendChild(cell);
      });

      tbody.appendChild(row);
    });

    modalHorario()
}
