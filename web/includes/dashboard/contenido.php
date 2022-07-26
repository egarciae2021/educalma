<?php
// Este codigo hace validacion para que no se pueda acceder a cualquier pagina sin estar logueado__Pablo Loyola
	ob_start();
	@session_start();
	if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
?>

<!--========== CONTENTS ==========-->
<?php 
    require_once 'database/databaseConection.php';
    $pdo    = Database::connect();
    error_reporting(0);
    $userId = $_SESSION['codUsuario'];
    //3 ultimos Cursos inscritos
    $sql    = 'SELECT * FROM cursoinscrito INNER JOIN cursos ON cursos.idCurso = cursoinscrito.curso_id  WHERE usuario_id = ? ORDER BY fechaInscripcion DESC LIMIT 3';
    $sql2   = 'SELECT * FROM cursoinscrito INNER JOIN cursos ON cursos.idCurso = cursoinscrito.curso_id  WHERE usuario_id = '.$userId.' AND avance = 100  ORDER BY fechaInscripcion DESC LIMIT 3';
    $stmt   = $pdo->prepare($sql);
    $stmt->execute([$userId]);
    $stmt2  = $pdo->prepare($sql2); 
    $stmt2->execute();
?>

<style>
	@import url('https://fonts.googleapis.com/css2?family=Baloo+Tamma+2:wght@400;500;600;700;800&display=swap');
    body{
		background-color: #f7f7f7;
    }
	#cursosModal {
		font-family: 'Baloo Tamma 2', cursive;
	}
	.container-img-curso::before {
		content: "";
		background: rgb(124,131,253);
		background: linear-gradient(90deg, rgba(124,131,253,1) 10%, rgba(255,255,255,0) 40%);		
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
	}
	.img-curso {
		width: 100%;
		height: 160px;
		object-fit: cover;
		overflow: hidden;
		max-width: unset;
	}
	div[id^="progress-bar"] {
		height: 26px;
		border: 1px solid #7C83FD;
		border-radius: 20px;
		padding: 0 2px;
	}
	div[id^="progress-bar"] .avance {
		background: rgb(124,131,253);
		background: linear-gradient(90deg, rgba(124,131,253,1) 0%, rgba(224,199,229,1) 100%);
		height: 20px;
		border-radius: 0 20px 20px 0;
	}
    @media (max-width:420px){
		.modalResponsive{
			width:80%;
		}
    }

	@media only screen and (min-width:390px) and (max-width:400px){
		.respons1{
			position: relative;
			top: -9em;
		}
    }

	@media only screen and (min-width:414px) and (max-width:420px){
		.respons1{
			position: relative;
			top: -11em;
		}
    }

	@media only screen and (min-width:412px) and (max-width:420px){
		.respons1{
			position: relative;
			top: -12em;
		}
    }

	@media only screen and (min-width:820px) and (max-width:830px){
		.respons1{
			position: relative;
			top: -33em;
		}
    }

	@media only screen and (min-width:768px) and (max-width:780px){
		.respons1{
			position: relative;
			top: -25em;
		}
    }

	@media only screen and (min-width:912px) and (max-width:920px){
		.respons1{
			position: relative;
			top: -41em;
		}
    }

	@media only screen and (min-width:540px) and (max-width:550px){
		.respons1{
			position: relative;
			top: -3em;
		}
    }



</style>

<main>
    <section class="about respons1" id="about" style="width:100%;height:100%;margin:0;padding:0;margin-left:2%">
        <div class="image col">
            <img style="position: relative; top: 45px;" src="./assets/images/tu_tablero.jpg" alt="">
        </div>

        <div class="content col" style="position: relative; top: 35px;">
			<div class="text-center">
				<span>Tu tablero</span>
			</div>
			<h3 class="title">¡El secreto real del éxito es el entusiasmo!</h3>

			<div class="icons-container">
				<a class="icons" id="open-modal" data-toggle="modal" data-target="#cursosModal">
					<img src="./assets/images/serv-3.png" alt="">
					<h3>Tus últimos cursos</h3>
				</a>

				<a class="icons" id="open-modal1" data-toggle="modal" data-target="#cursosModal2">
					<img src="./assets/images/serv-3.png" alt="">
					<h3>Cursos completados</h3>
				</a>

				<a class="icons" id="open-modal2" href="sidebarCursos.php">
					<img src="./assets/images/serv-3.png" alt="">
					<h3>Cursos inscritos</h3>
				</a>
        	</div>
		</div>
    </section>
	<!-- modal -->
    <div class="modal fade" id="cursosModal" role="dialog">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content px-1">
				<!-- <div class="modal-header"></div> -->
				<div class="modal-body py-1">
					<div class="d-flex flex-column" style="gap: 10px;">
						<!--Cursos Inicio -->
						<?php $id = 0 ?>
						<?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
							<div class="row" style="border: 1px solid rgba(0,0,0,.2); border-radius: 10px; overflow: hidden;">
								<div class="col-12">
									<div class="row">
										<div class="col-6 pl-4 pr-0 d-flex flex-column justify-content-center" style="background-color: #7C83FD; color: white;">
											<h3 class="font-weight-bold"><?php echo $row['nombreCurso'] ?></h3>
											<p class="mb-0" style="font-size: .9rem;">Creado por la Fundación CALMA.</p>
										</div>
										<div class="col-6 px-0 container-img-curso">
											<img class="img-curso" src="<?php echo $row['imagenDestacadaCurso'] ?>" alt="Imagen Curso" style="">
										</div>
									</div>
								</div>
								<div class="col-12">
									<p class="mb-0 mt-2 pl-1" style="color: #7C83FD; font-weight: 600;">Progreso</p>
									<div id="progress-bar<?php echo $id ?>" class="w-100 d-flex align-items-center">
										<div id="progress-number<?php echo $id ?>" data-progress="<?php echo  $row['avance'] ?>"></div>
										<div class="w-100" style="border-radius: 20px; overflow: hidden;">
											<div class="avance"></div>
										</div>
										<style>
											<?php echo "#progress-bar".$id ?> .avance {
												animation: progress-anim<?php echo $id?> 2s forwards;
											}
											@keyframes progress-anim<?php echo $id?> {
												0% {width: 0%;}
												100% {width: <?php echo $row['avance']."%" ?>;}
											}
										</style>
									</div>
									<p class="mb-2 mt-1 pl-1" style="color: #7C83FD; font-weight: 600;"><?php echo $row['avance'] ?>% completo</p>
								</div>
							</div>
							<!-- <script>
								const btnModal = document.getElementById("open-modal");
								const modal = document.getElementById("cursosModal");
								btnModal.addEventListener("click", function() {
									setTimeout(function(){
										if (modal.classList.contains("show")) {
											const progress = document.getElementById("progress-number").dataset.progress;
											console.log(progress);
										}
									}, 300);
								});
							</script> -->
						<?php $id++; } ?>
						<!--Cursos Fin -->
					</div>
				</div>
				<!-- <div class="modal-footer"></div> -->
			</div>
		</div>
    </div>
    <!-- fin Modal1 -->
    <!-- modal2 -->
    <div class="modal fade" id="cursosModal2"  role="dialog" >
	<div class="modal-dialog">
	<center>
	<div class="modal-content modalResponsive" >
	<div class="modal-body" > 
	    <div class="container-fluid">
		    <center>
		    <?php
			$n = 0;
			while($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
			    $n++;
		    ?>
		    <!--cursos Inicio -->
		    <a href="curso.php?id=<?php echo $row['idCurso'] ?>" style="text-decoration:none">
		    <div class="col-12 pt-4">
			<div class="card mb-3" style="max-width: 540px; height:20%">
			    <div class="row no-gutters" style="text-align:left;">
				<div class="col-md-6">
				<img src="<?php echo $row['imagenDestacadaCurso'] ?>" class="card-img" alt="Imagen Curso" style="width:100%; height:100%">
				</div>
				<div class="col-md-6" style="height:160">
				    <div class="card-body">
				    <h5 class="card-title" style="color:#7C83FD"><?php echo $row['nombreCurso'] ?></h5>
					    <p class="card-text"><small class="text-muted">Creado por Fundación CALMA</small></p>
					    <p class="card-text" style="color:#7C83FD">Calificación: <?php echo $row['nota'] ?></p>
				    </div>
				</div>
			    </div>
			</div>		    
		    </div>
		    <!--cursos fin -->
		    </a>
		    <?php }
		    if($n==0){
		     ?>
		    <div class="col-12 pt-4">
			<div class="card mb-3" style="max-width: 540px; height:15%">
			    <div class="row no-gutters" style="text-align:center;align-content:center">
				<div class="col-md-12 pt-3" style="height:150; text-align:center">
				    <div class="card-body" style="text-align:center">
				    <h5 class="card-title" style="color:#7C83FD">Aun no completo ningun Curso</h5>
				    </div>
				</div>
			    </div>
			</div>		    
		    </div>
		    <?php } ?>
		    </center>
	    </div>
	</div>
	</div>
	</center>
	</div>
    </div>
    <!-- fin Modal2 -->
</main>



<?php
    }
    else{
        header('Location: ../../iniciosesion.php');
    }
?>
