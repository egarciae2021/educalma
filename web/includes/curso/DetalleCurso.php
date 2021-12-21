<head>
    <title>Bootstrap Example</title>

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styledetcurso.css">
</head>

<body>

    <?php
    require_once 'database/databaseConection.php';
    $id = $_GET['id'];
    $pdo4 = Database::connect();
    $sql4 = "SELECT * FROM cursos WHERE idCurso='$id'";
    $q4 = $pdo4->prepare($sql4);
    $q4->execute(array());
    $dato4 = $q4->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
    ?>
    <div class="bg-dark1">
        <div class="row py-4">
            <br>
        </div>
    </div>
    <div class="bg-dark1">
        <div class="row py-5">
            <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xl-8 ">
                <span>Desarrollo</span><i class="fas fa-angle-right mx-2"></i>
                <span>Desarrollo web</span><i class="fas fa-angle-right mx-2"></i>
                <span>Desarrollo web</span>
                <h2 class="my-2 font-weight-bold">Universidad Desarrollo Web 2021 - FrontEnd Web Developer !</h2>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Neque recusandae quod culpa maxime commodi
                    dolor eaque fugit delectus provident optio deleniti quae, soluta voluptates repellat saepe nostrum
                    dolore doloribus omnis.</p>
                <i class="fas fa-stopwatch mr-2"></i><span>Fecha: Lorem ipsum dolor sit amet.</span>
                <i class="fas fa-globe ml-4 mr-2"></i><span>Español</span>
                <i class="fas fa-closed-captioning ml-4 mr-2"></i><span>Español [automático]</span>
            </div>
            <div class="col-12 col-sm-12 col-md-5 col-lg-4 col-xl-4 info-course-right">
                <div class="card" style="position: absolute;width: 90%; ">
                    <img class="card-img-top" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSAPars5s2FQzySbkUpPjtBlvPlANAFDLP7x38q8nOqcke_Lrf_if34Y-kTjGQgS6pRvuQ&usqp=CAU" alt="Card image" style="width:100%">
                    <div class="card-body">
                        <h4 class="card-title font-weight-bold" style="font-size: 30px;">s/ 49,90</h4>
                        <button type="button" class="btn btn-outline-dark my-3">Comprar ahora</button>
                        <p class="font-weight-bold mb-0">Este curso incluye:</p>
                        <div class="my-1" style="font-size: 13px;">
                            <div><i class="fab fa-youtube text-center" style="width: 1.5rem;"></i><span class="ml-3">Lorem
                                    ipsum dolor sit.</span></div>
                            <div><i class="far fa-file text-center" style="width: 1.5rem;"></i><span class="ml-3">Lorem
                                    ipsum
                                    dolor sit.</span></div>
                            <div><i class="far fa-folder-open text-center" style="width: 1.5rem;"></i><span class="ml-3">Lorem
                                    ipsum dolor sit.</span></div>
                            <div><i class="fas fa-infinity text-center" style="width: 1.5rem;"></i><span class="ml-3">Lorem
                                    ipsum dolor sit.</span></div>
                            <div><i class="fas fa-mobile-alt text-center" style="width: 1.5rem;"></i><span class="ml-3">Lorem
                                    ipsum dolor sit.</span></div>
                            <div><i class="fas fa-clipboard-check text-center" style="width: 1.5rem;"></i><span class="ml-3">Lorem ipsum dolor sit.</span>
                            </div>
                            <div><i class="fas fa-trophy text-center" style="width: 1.5rem;"></i><span class="ml-3">Lorem ipsum
                                    dolor sit.</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-light">
        <div class="row py-5">
            <div class="col-12 col-sm-12 col-md-5 col-lg-4 col-xl-4 info-course-left" style="border: 1px solid red;">
                <h4>Contenido del curso</h4>
            </div>
            <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xl-8 text-dark">
                <h4 class="font-weight-bold">Contenido del curso</h4>
                <div class="d-flex">
                    <div class="mr-auto p-2">
                        <span class="mr-1">47</span>secciones <i class="fas fa-circle mx-2" style="font-size: 5px;"></i>
                        <span class="mr-1">313</span>secciones <i class="fas fa-circle mx-2" style="font-size: 5px;"></i>
                        <span class="mr-1">30 h 21 m</span>Lorem, ipsum dolor.
                    </div>
                    <div class="p-2">
                        <h6>Ampliar todas las secciones</h6>
                    </div>
                </div>
                <div id="accordion">
                    <div class="card">
                        <a class="card-header card-link" data-toggle="collapse" href="#collapseOne">
                            <span><i class="fas fa-sort-down mr-3"></i> aaaaaaaaaaaaa</span>
                        </a>
                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                            <div class="card-body">
                                Lorem ipsum..
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <a class="card-header collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                            <span><i class="fas fa-sort-down mr-3"></i> aaaaaaaaaaaaa</span>
                        </a>
                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                Lorem ipsum..
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <a class="card-header collapsed card-link" data-toggle="collapse" href="#collapseThree">
                            <span><i class="fas fa-sort-down mr-3"></i> aaaaaaaaaaaaa</span>
                        </a>
                        <div id="collapseThree" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                Lorem ipsum..
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <a class="card-header collapsed card-link" data-toggle="collapse" href="#collapsefour">
                            <span><i class="fas fa-sort-down mr-3"></i> aaaaaaaaaaaaa</span>
                        </a>
                        <div id="collapsefour" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                Lorem ipsum..
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <a class="card-header collapsed card-link" data-toggle="collapse" href="#collapsefifth">
                            <span><i class="fas fa-sort-down mr-3"></i> aaaaaaaaaaaaa</span>
                        </a>
                        <div id="collapsefifth" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                Lorem ipsum..
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>