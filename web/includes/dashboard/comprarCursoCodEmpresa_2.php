<head>
    <link rel="stylesheet" href="assets/css/cursos.css">
</head>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto:300');

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

            background-color: #0010FF;
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
            /* background-image: url("./assets/img/fondop33.jpg"); */
            /* width: 1313px;
            height: 724px; */
            /* background-color: red; */
            background-image: url("./assets/img/codigo_empresa.png");
            background-size: 200px 200px;
            background-size: 100% 100%;
            background-repeat: no-repeat;
        }

        @media only screen and (max-width: 620px) {

            .login-page {
                width: 300px;
                padding: 8% 0 0;
                margin: auto;
            }
        }
    </style>

<body>
    <?php
        if (isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)) {
    ?>

    <div class="login-page">
        <div class="form">
            <form class="login-form">
                <!-- Codigo Empresa -->
                <div class="col my-3">
                    <label for="txtcodigo" style="float:left;"><strong>Código de Empresa</strong></label>
                    <br>
                    <input type="text" style="display: block; width: 100%; height:calc(1.5em + .75rem + 2px); padding: 0.375rem 0.75rem; font-size: 1rem; font-weight: 400; line-height: 1.5; background-clip: padding-box; border: 1px solid #ced4da; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out" id="txtcode" placeholder="Ingresar código" />
                </div>
                <button><strong>Validar</strong></button>
            </form>
        </div>
    </div>

    <script>
        $('.message a').click(function(){
            $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
        });
    </script>

    <?php

        } else {
            header('Location:iniciosesion.php');
        }
    ?>
</body>