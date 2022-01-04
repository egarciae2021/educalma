<?php
require_once 'database/databaseConection.php';
?>

<head>
    <link rel="stylesheet" href="assets/css/pagepay.css" />
</head>

<body>

    <header style="background-color: #ffffff77;">
        <div class="container-header navbar-fixed-top" style="max-width: 95rem;">
            <input type="checkbox" name="" id="check">
            <div class="logo-container">
                <a href="index.php"><img src="assets/images/Logo.svg" alt=""></a>
            </div>
            <div class="nav-btn-header">
                <div class="nav-links-header">
                </div>
                <div class="log-sign" style="--i: 1.8s">
                    <ul>
                        <li class="nav-link" style="--i: .6s">
                            <a href="#">Cerrar</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="hamburger-menu-container">
                <div class="hamburger-menu">
                    <div></div>
                </div>
            </div>
        </div>
    </header>
    <div class="container pt-5">
        <div class="row pt-5">
            <div class="col-12 mb-3 container-navbar-router">
                <a href="#">Inicio</a><i class=" mx-3 fas fa-chevron-right"></i>
                <span>Proceso de pago</span>
            </div>
            <!-- col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 -->
            <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xl-8 mb-0">
                <form action="" style="height: 100%;">
                    <div class="container-pay px-4" style="background-color: white;height: 100%;">
                        <div class="d-flex justify-content-between">
                            <div class="mt-3">
                                <h4>Elige tu medio de pago</h4>
                            </div>
                            <div class="mt-2">
                                <span><a href=" #">¿Necesitas ayuda?</a></span>
                            </div>
                        </div>
                        <div class="container-pay-online my-3">
                            <div class="col-12">
                                <div class="py-3">
                                    <i class="far fa-credit-card mr-3"></i>Pago online
                                </div>
                            </div>
                        </div>
                        <div id="accordion">
                            <div class="card mb-3">
                                <a class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="fas fa-chevron-down mr-2"></i>Tarjeta <img src="assets/images/visa.png" alt="" height="13px">
                                </a>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        Lorem ipsum dolor sit amet.
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <a class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="fas fa-chevron-down mr-2"></i>Tarjeta <img class="ml-1" src="assets/images/paypal (1).png" alt="" height="13px">
                                </a>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body">
                                        Lorem ipsum dolor sit amet.
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <a class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <i class="fas fa-chevron-down mr-2"></i>Tarjeta de débito
                                </a>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                    <div class="card-body">
                                        Lorem ipsum dolor sit amet.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 col-sm-12 col-md-5 col-lg-4 col-xl-4">
                <div class="container-info-course" style="background-color: white;">
                    <div class="px-4 py-2">
                        <h5>Detalles del pedido</h5>
                        <!-- <p class="m-0">Curso:</p> -->
                        <div class="d-flex flex-column">
                            <span>Nombre del curso</span>
                            <span>Descripción del curso</span>
                            <span>Nombre del curso</span>
                        </div>
                    </div>
                </div>
                <div class="container-info-resumen mt-3" style="background-color: white;">
                    <div class="px-4 py-3">
                        <h5>Resumen de pedido</h5>
                        <!-- <p class="m-0">Curso:</p> -->
                        <div class="row">
                            <div class="col-6">Producto</div>
                            <div class="col-6 text-right"><span>s/99.90</span></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-5 col-lg-6 col-xl-5">
                                <div class="container-image-detalle" style="width:100px; height:100px">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSAPars5s2FQzySbkUpPjtBlvPlANAFDLP7x38q8nOqcke_Lrf_if34Y-kTjGQgS6pRvuQ&usqp=CAU" alt="">
                                </div>
                            </div>
                            <div class="col-7 col-lg-6 col-xl-7 text-leftt"><span>nombre de curso</span>
                                <p class="font-weight-bold text-danger">s/99.90</p>
                            </div>
                        </div>
                        <hr>
                        <div class="mt-2">
                            <h4 style="font-size: 10px;">Los productos podrán ser descargados una vez que se procede el pago</h4>
                            <h5 class="font-weight-bold" style="font-size: 8px;">(Para aclaraciones giancarlosuggardaddy@gmail.com)</h5>
                        </div>
                    </div>

                    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>