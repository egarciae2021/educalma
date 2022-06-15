<head>
    <style>
        * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  
  background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5));
    background-color:Silver;
  background-repeat: no-repeat;
    background-position: center top;
    background-attachment: fixed;
    background-size: contain;
}

.form-register {
  width: 500px;
  background: #24303c;
  padding: 30px;
  margin: auto;
  margin-top: 100px;
  border-radius: 4px;
  font-family: 'calibri';
  color: white;
  box-shadow: 7px 13px 37px #000;
}

.form-register h4 {
  font-size: 22px;
  margin-bottom: 20px;
}

.controls {
  width: 100%;
  background: #24303c;
  padding: 10px;
  border-radius: 4px;
  margin-bottom: 16px;
  border: 1px solid #1f53c5;
  font-family: 'calibri';
  font-size: 18px;
  color: white;
}


.form-register .boton3 {
  width: 100%;
  background: #6D6C6C;
  border: 1px solid #1f53c5;
  padding: 12px;
  color: white;
  margin: 16px 0;
  font-size: 16px;
}


.form-register .boton3:hover {
  background: #1f53c5;
  color: #fff !important;
}

    </style>
</head>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  <title>Generador de Certificados</title>
</head>
<body>
<form method="POST" action="ejemplo2.php" class="form-register">
    <img src="../assets/img/logo_educalma.svg">
    <br>
    <center><h4>Generador de Certificados</h4></center>
    <br>
    <label for="nombre_curso">Nombre del Curso</label><br><br>
    <input class="controls" type="text" name="nombre_curso" id="nombre_curso" placeholder="Ingrese Nombre del Curso">
    <br>

    <label for="nombre_estudiante">Nombre de Estudiante</label><br><br>
    <input class="controls" type="text" name="nombre_estudiante" id="nombre_estudiante" placeholder="Ingrese su Nombres Completos">
    <br>
    <label for="cod_alumno">Codigo del Alumno</label><br><br>
    <input class="controls" type="text" name="cod_alumno" id="cod_alumno" placeholder="Ingrese Codigo del Alumno">
    <br>

    <label for="cod_curso">Codigo del Curso</label><br><br>
    <input class="controls" type="text" name="cod_curso" id="cod_curso" placeholder="Ingrese Codigo del Curso">
    <input class="boton3" type="submit" value="Generar">

</form>

</body>
</html>