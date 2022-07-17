<?php   
    ob_start();
    @session_start();
?>
<?php include_once 'includes/Inicio/Head.php' ?>

<head>
    <link rel="shortcut icon" href="assets/images/logo_edu.png">

    <style>

        body {
            background: linear-gradient(to bottom, #FFFFFF 15%, #E0C7E5, #E7F4FF 70%);


            margin: auto !important;
            padding: auto !important;
        }

        .foot {
            
            margin-top: -350px;
        }

        @media (max-width: 720px){

            body {
                background: linear-gradient(to bottom, #FFFFFF 10%, #E0C7E5, #E7F4FF 60%);
            }

            .foot {
                
                margin-top: -200px;
            }
            
        }

        @media (max-width: 990px){

            body {
                background: linear-gradient(to bottom, #FFFFFF 10%, #E0C7E5, #E7F4FF 60%);
            }

            .foot {
                
                margin-top: -200px;
            }

        }

        @media (max-width: 400px){

            body {
                background: linear-gradient(to bottom, #FFFFFF 10%, #E0C7E5, #E7F4FF 60%);
            }

            .foot {
                
                margin-top: -200px;
            }

        }


    </style>
</head>

<body style="margin: auto; padding: auto;" id="home" data-spy="scroll" data-target="#navbar-wd" data-offset="98">
    
    <?php //include_once 'includes/Inicio/loader.php' ?>
    
    <?php include_once 'includes/Inicio/Header.php' ?>

       <div style="position: relative; top: -50px;">

        <?php include_once 'includes/curso/videoCurso.php' ?>

    </div>

    <?php include_once 'includes/Inicio/Footer.php' ?>

    <script src="assets/js/home.js"></script>

</body>
