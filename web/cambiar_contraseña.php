<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
    <script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

    <title>Cambiar contraseña</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:300);

        .login-page {
        width: 360px;
        padding: 8% 0 0;
        margin: auto;
        }
        .form {
        position: relative;
        z-index: 1;
        background: #FFFFFF;
        max-width: 360px;
        margin: 0 auto 100px;
        padding: 45px;
        text-align: center;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }
        .form input {
        font-family: "Roboto", sans-serif;
        outline: 0;
        background: #f2f2f2;
        width: 100%;
        border: 0;
        margin: 0 0 15px;
        padding: 15px;
        box-sizing: border-box;
        font-size: 14px;
        }
        .form button {
        font-family: "Roboto", sans-serif;
        text-transform: uppercase;
        outline: 0;
        background: #737BF1;;
        width: 100%;
        border: 0;
        padding: 15px;
        color: #FFFFFF;
        font-size: 14px;
        -webkit-transition: all 0.3 ease;
        transition: all 0.3 ease;
        cursor: pointer;
        }
        .form button:hover,.form button:active,.form button:focus {
        background: #43A047;
        }
        .form .message {
        margin: 15px 0 0;
        color: #b3b3b3;
        font-size: 12px;
        }
        .form .message a {
        color: #737BF1;
        text-decoration: none;
        }
        .form .register-form {
        display: none;
        }
        .container {
        position: relative;
        z-index: 1;
        max-width: 300px;
        margin: 0 auto;
        }
        .container:before, .container:after {
        content: "";
        display: block;
        clear: both;
        }
        .container .info {
        margin: 50px auto;
        text-align: center;
        }
        .container .info h1 {
        margin: 0 0 15px;
        padding: 0;
        font-size: 36px;
        font-weight: 300;
        color: #1a1a1a;
        }
        .container .info span {
        color: #4d4d4d;
        font-size: 12px;
        }
        .container .info span a {
        color: #000000;
        text-decoration: none;
        }
        .container .info span .fa {
        color: #EF3B3A;
        }
        body {
        background: #99ccff;
        font-family: "Roboto", sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;      
        }

        @media only screen and (max-width: 620px) {

            .login-page {
                width: 300px;
                padding: 8% 0 0;
                margin: auto;
            }
        }
    </style>
</head>
<body>
<div class="login-page">
  <div class="form">
    <form class="login-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
      <input type="password" id="new_pass" name="new_pass" placeholder="Ingrese una nueva contraseña"/>
      <input type="password" placeholder="Vuelva a ingresar la nueva contraseña"/>
      <input value="<?php $toks = $_GET["token"]; echo$toks;?>" name = "token" type="hidden">
      <button type="submit" >Cambiar contraseña</button>
      <!--<p class="message">Not registered? <a href="#">Create an account</a></p>-->
    </form>
  </div>
</div>


<?php



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $passn = $_POST['new_pass']; 
    $tok = $_POST['token'];  
    $password = password_hash($passn, PASSWORD_BCRYPT);
 
     $enlace = new mysqli('20.226.29.168', 'root', '', 'educalma');
     $querys=("Select * from recover_password where token ='".$tok."'");
     $resultado = $enlace->query($querys); 
    
    $resultado2 = mysqli_fetch_row($resultado);
    $send_correo = $resultado2[2];

     $num_filas = mysqli_num_rows($resultado);
      if($num_filas==1){
                            if($enlace){ 
                                      $querys= ("UPDATE usuarios SET  `pass`='".$password."' WHERE `email`='".$send_correo."'");
                                      $enlace->query($querys);  
                                      echo "<script>alert('Se actulizo correctamente la clave, inicia sesión')</script>";
                                      echo '<script>window.location="index.php";</script>';   
                                } 
                        }
      elseif($num_filas==0)
      {echo "<script>alert('No se encontro la cuenta de correo asociada')</script>";} 
}
?>
  

<script>
    $('.message a').click(function(){
        $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
    });

   
</script>
</body>
</html>