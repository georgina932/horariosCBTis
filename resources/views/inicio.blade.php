<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sistema de Administración de Horarios</title>
<style>
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
body, html {
  margin: 0;
  padding: 0;
  height: 100%;
  font-family: Arial, sans-serif;
}

.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #cac2c2;
  /* Agrega la imagen de fondo y configura su tamaño y posición */

  background-size: cover; /* Cubre toda la pantalla */
  background-position: center; /* Centra la imagen */
}

.background-image {
  position: relative;
  width: 100%;
  max-width: 1200px;
}

.background-image h1 {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 3em;
  color: #ffffff;
  text-align: center;
}

.options {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 10px;
  margin-top: 20px;
}

.options a {
  display: inline-block;
  padding: 10px 20px;
  background-color: #9D2449;
  color: #ffffff;
  text-decoration: none;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

.options a:hover {
  background-color: #7A1E39;
}
</style>
</head>
<body>

    <div class="header">
        <img src="images/logo2.png" alt="Logo"> <!-- Aquí debes especificar la ruta de tu imagen -->
        <h2>Sistema de administración de horarios del CBTis 255</h2>
      </div>

  <div class="container">
    <div class="background-image">

      <div class="options">
        <a href="principal"><i class="fas fa-home"></i> Inicio</a>
        <a href="docentes"><i class="fas fa-user"></i> Docentes</a>
        <a href="asignaturas"><i class="fas fa-book"></i> Asignaturas</a>
        <a href="salones"><i class="fas fa-book"></i> Salones</a>
        <a href="horarios"><i class="fas fa-calendar-alt"></i> Creación de Horarios</a>
        <a href="#"><i class="fas fa-book"></i> Reportes</a>
        <a href="index" style="background-color: #7A1E39;"><i class="fas fa-sign-out-alt"></i>Salir</a>
      </div>
    </div>
  </div>
</body>
</html>
