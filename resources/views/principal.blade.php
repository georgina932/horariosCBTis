<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inicio</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Agrega el enlace para Font Awesome -->
<style>
/* Estilos del encabezado */
.header  {
  background-color: #9D2449;
  color: white;
  text-align: center;
  padding: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: Arial, sans-serif;

}

.header img {
  max-width: 300px; /* Ajusta el tamaño máximo de la imagen según tus necesidades */
  margin-right: 60px;
  margin-left: -450px;
   /* Espacio entre la imagen y el texto */
}

.header h2 {
  margin-left: 0; /* Eliminamos el margen predeterminado del h2 */
}

/* Estilos de los botones */
.buttons {
  background-color: #f2f2f2;
  padding: 20px;
  text-align: center;
}

.buttons a {
  display: inline-block;
  background-color: #9D2449;
  color: white;
  text-decoration: none;
  padding: 15px 25px;
  margin: 10px;
  border-radius: 5px;
  font-family: Arial, sans-serif;
}

.buttons a:hover {
  background-color: #7A1E39;
}
</style>
</head>
<body>

<div class="header">
  <img src="images/logo2.png" alt="Logo"> <!-- Aquí debes especificar la ruta de tu imagen -->
  <h2>Sistema de administración de horarios del CBTis 255</h2>
</div>

<div class="buttons">
  <a href="principal"><i class="fas fa-home"></i> Inicio</a>
  <a href="docentes"><i class="fas fa-user"></i> Docentes</a>
  <a href="asignaturas"><i class="fas fa-book"></i> Asignaturas</a>
  <a href="salones"><i class="fas fa-book"></i> Salones</a>
  <a href="horarios"><i class="fas fa-calendar-alt"></i> Creación de Horarios</a>
  <a href="#"><i class="fas fa-book"></i> Reportes</a>
  <a href="index" style="background-color: #7A1E39;"><i class="fas fa-sign-out-alt"></i>>Salir</a>
</div>

</body>
</html>

