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
    $sql    = 'SELECT * FROM cursoinscrito INNER JOIN cursos ON cursos.idCurso = cursoinscrito.curso_id  WHERE usuario_id = '.$userId.' ORDER BY fechaInscripcion DESC LIMIT 3';
    $sql2   = 'SELECT * FROM cursoinscrito INNER JOIN cursos ON cursos.idCurso = cursoinscrito.curso_id  WHERE usuario_id = '.$userId.' AND avance = 100  ORDER BY fechaInscripcion DESC LIMIT 3';
    $stmt   = $pdo->prepare($sql);
    $stmt->execute();
    $stmt2  = $pdo->prepare($sql2); 
    $stmt2->execute();

?>
<style>
    @media (max-width:420px){
	.modalResponsive{
	    width:80%    
	}
    }
</style>
<main>
    <section class="about" id="about">
        <div class="image col" >
            <img style="position: relative; top: 80px;" src="./assets/images/tu_tablero.jpg" alt="">
        </div>

        <div class="content col" style="position: relative; top: 80px;">
	    <center>
            <span style="text-align:center">Tu tablero</span>
	    </center>
            <h3 class="title">¡El secreto real del éxito es el entusiasmo!</h3>

            <div class="icons-container">
                <a class="icons" id="open-modal" data-toggle="modal" data-target="#cursosModal">
                    <img src="./assets/images/serv-3.png" alt="">
                    <h3>Tus últimos cursos</h3>
                </a>

                <a class="icons" id="open-modal1" data-toggle="modal" data-target="#cursosModal2">
                    <img src="./assets/images/serv-3.png" alt="">
		    <h3>Cursos completados </h3>
                </a>
		<a class="icons" id="open-modal2" href="sidebarCursos.php">
                    <img src="./assets/images/serv-3.png" alt="">
                    <h3>Cursos inscritos</h3>
                </a>

        </div>

	<!-- modal -->
    <div class="modal fade" id="cursosModal"  role="dialog" >
	<div class="modal-dialog">
	<center>
	<div class="modal-content modalResponsive" >
	<div class="modal-body" > 
	    <div class="container-fluid">
		    <center>
		    <?php
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
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
					    <p class="card-text" style="color:#7C83FD">Progreso: <?php echo $row['avance'] ?>%</p>
				    </div>
				</div>
			    </div>
			</div>		    
		    </div>
		    <!--cursos fin -->
		    </a>
		    <?php } ?>
		    </center>
	    </div>
	</div>
	</div>
	</center>
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
    </section>
</main>



<?php
    }
    else{
        header('Location: ../../iniciosesion.php');
    }
?>
