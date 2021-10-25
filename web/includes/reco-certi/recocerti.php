<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reconocedor de certificado</title>
  <link rel="stylesheet" href="././assets/css/stycerti.css">
</head>

<body>

    <section class="main">
        <div class="login-container">
            <img class="image" src="./assets/images/logo.svg" width="30%" alt="#">
            <p class="title">Verificar un certificado</p>
            <div class="separator"></div>
            <form class="login-form" id="form-registro" action="includes/reco-certi/validarCertificado.php" target="dummyframe">
                <div class="form-control">
                    <input type="text" name="codigo" id="codigo-certificado" placeholder="INTRODUCE EL CÓDIGO">
                    <i class="fas fa-award"></i>
                </div>
                <p class="welcome-message">El codigo aparece en la parte superior del certificado</p>
                <button type="submit" class="submit">Validar</button>
                <a href="ListaCursos.php" type="submit" class="submit-button">Ver cursos</a>
            </form>
        </div>
    </section>

</body>