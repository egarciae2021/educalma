<?php
ob_start();
@session_start();
if (isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)) {
  require_once 'database/databaseConection.php';
?>

  <head>
    <link rel="stylesheet" href="assets/css/plugins/bootstrap.min.css" />
    <link rel="stylesheet" href="includes/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="assets/css/styledash.css">
  </head>

  <!-- para lista de cursos -->
  <?php
  $pdo3 = Database::connect();

  $sqlz = "SELECT * FROM cursos where permisoCurso=1 order by idCurso DESC ";
  $qz = $pdo3->prepare($sqlz);
  $qz->execute();

  $contar = $qz->rowCount();

  if ($_SESSION['privilegio'] == 2) {
    $idProfe = $_SESSION['codUsuario'];
    $sql3 = "SELECT * FROM cursos WHERE id_userprofesor='$idProfe' order by idCurso DESC";
  } else {
    $idProfe = $_SESSION['codUsuario'];
    $sql3 = "SELECT * FROM cursos WHERE permisoCurso=1 order by idCurso DESC ";
  }

  $q3 = $pdo3->prepare($sql3);
  $q3->execute();
  $curso = $q3->fetchAll(PDO::FETCH_ASSOC);

  ?>

  <main>

    <div class="container-fluid">
      <div class="row mt-5">
        <div class="col-12">
        <div class="title" style="color:#737BF1;">Reporte</div>
          <div class="row">
            <div class="col-12">
              <nav class="navbar navbar-expand">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link active" href="reporteUsuario.php">
                      por usuarios
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="reporteEmpresa.php">
                      por empresas
                    </a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link" href="reporteAprobado.php">
                      por aprobados
                    </a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link" href="reporteDesaprobado.php">
                      por desaprobados
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>

          <?php
          $pdo3 = Database::connect();
          $sqlCur = "SELECT COUNT(*) AS cantidad FROM cursos WHERE permisoCurso = 1;";
          $qCur = $pdo3->prepare($sqlCur);
          $qCur->execute(array());
          $resultCurs = $qCur->fetch(PDO::FETCH_ASSOC);
          ?>

          <!-- TABLA DE CURSOS -->
          <div class="col-12 mt-5 text-center">
            <div class="card">




              <div class="card-header">
                <div class="row mb-2">
                  <div class="col-12">
                    <h3 class="card-title" style="color:#737BF1;">Cantidad de cursos
                      <span style="color:#BEC1F3;">(<?php echo $resultCurs['cantidad']; ?>)</span>
                    </h3>
                  </div>
                </div>
              </div>



              <!-- /.card-header -->
              <div class="card-body">



                <div class="table-responsive">
                  <!--class="standard-grid1 full-width content-scrollable"-->
                  <table id="tablaCursos" class="table table-borderless dt-responsive" cellspacing="0" width="auto">

                    <thead>
                      <tr style="background-color:#737BF1;">
                        <th style="border-radius: 10px 0 0 10px;">Imagen</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Categoría</th>
                        <th>Dirigido</th>
                        <th>Costo</th>
                        <th>Publicado</th>
                        <th style="border-radius: 0 10px 10px 0;">Acciones</th>
                      </tr>
                    </thead>

                    <tbody>

                      <?php
                      foreach ($curso as $curso) {
                        $pdo4 = Database::connect();
                        $idCate = $curso['categoriaCurso'];
                        $sql4 = "SELECT * FROM categorias WHERE idCategoria = '$idCate'";
                        $q4 = $pdo4->prepare($sql4);
                        $q4->execute(array());
                        $datoCate = $q4->fetch(PDO::FETCH_ASSOC);
                        $dotocoto = $q4->fetchAll();
                      ?>

                        <tr class="h-100 justify-content-center align-items-center">
                          <td>
                            <?php
                            if ($curso['imagenDestacadaCurso'] != null) {
                            ?>
                              <img style="height: 40px;" class="rounded-circle" src="data:image/*;base64,<?php echo base64_encode($curso['imagenDestacadaCurso']) ?>">
                            <?php
                            } else {
                            ?>
                              <img style="height: 40px;" class="rounded-circle" src="./assets/images/curso_educalma.png">
                            <?php
                            }
                            ?>
                          </td>
                          <td>
                            <?php echo $curso['nombreCurso']; ?>
                          </td>
                          <td width="330" height="80">
                            <?php echo substr($curso['descripcionCurso'], 0, 70) . "..."; ?>
                          </td>
                          <td>
                            <?php echo $datoCate['nombreCategoria']; ?>
                          </td>
                          <td>
                            <?php echo $curso['dirigido']; ?>
                          </td>
                          <td>
                            <?php echo $curso['costoCurso']; ?>
                          </td>
                          <td>
                            <?php echo $curso['fechaPulicacion']; ?>
                          </td>
                          <td>
                            <!--para editar curso-->
                            <div class="btn-group" role="group">
                              <a href="editarcurso.php?id=<?php echo $curso['idCurso']; ?>">
                                <button type="button" class="btn btn-edit">
                                  <i class="far fa-edit"></i>
                                </button>
                              </a>
                            </div>
                            <!-- para quitar curso -->
                            <div class="btn-group" role="group">
                              <button type="button" class="btn btn-quitar" data-toggle="modal" data-target="#ModalquitarCurso<?php echo $curso['idCurso']; ?>">
                                <i class="fas fa-trash-alt"></i>
                              </button>
                              </a>
                            </div>
                            <div class="modal fade" id="ModalquitarCurso<?php echo $curso['idCurso']; ?>" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h6 class="modal-title">Eliminar Curso</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form name="formulario" id="form-eliminarCurso" target="dummyframe" method="POST">
                                    <div class="modal-body px-4">
                                      <center>
                                        <h6>¿Estás seguro de eliminar este curso?</h6>
                                      </center>
                                      <input type="text" class="form-control" value="<?php echo $curso['nombreCurso']; ?>" aria-label="CursoAgr" disabled>
                                      <input type="hidden" name="idcurso" value="<?php echo $curso['idCurso']; ?>">
                                    </div>
                                    <div class="modal-footer">
                                      <a href="includes/Cursos_crud/Cursos_CRUD.php?id_eliminar=<?php echo $curso['idCurso']; ?>" type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i>Si, Eliminar</a>
                                      <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                </div>
                </td>
                </tr>

              <?php }
                      Database::disconnect();
              ?>

              </tbody>
              </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- fin tabla cursos -->

            <?php
            $pdo3 = Database::connect();
            $sql3 = "SELECT COUNT(*) AS cantidad FROM categorias";
            $q3 = $pdo3->prepare($sql3);
            $q3->execute(array());
            $resultCa = $q3->fetch(PDO::FETCH_ASSOC);
            ?>

            <!-- tablas (2) categorias  -->
            <div class="row">
              <div class="col-12">
                <h3 class="card-title my-3" style="color:#737BF1;">Cantidad de categorías
                  <span style="color:#BEC1F3;">(<?php echo $resultCa['cantidad']; ?>)</span>
                </h3>
              </div>
            </div>
            <div class="row">
              <!-- tabla añadir categorias -->
              <div class="col-12 col-md-6">
                <div class="card t-categ">
                  <div class="card-body">
                    <div class="table-responsive">
                      <form id="formRegis" action="includes/categorias/checkAgrCateg.php" target="dummyframe" method="POST" onsubmit="return comprobarCategoria()" style="padding:0;">
                        <table id="" class="table table-borderless text-center dt-responsive text-center" cellspacing="0 " width="100%">
                          <thead>
                            <tr style="background-color:#737BF1;">
                              <th style="border-radius:10px;">
                                nombre de categoría
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>
                                <input class="form-control" type="text" id="categoria_agregar" name="categoria_agregar" aria-describedby="temaAgr-addon" placeholder="Ingrese nombre de categoría" required>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <button type="submit" id="categoria_agregar" class="btn btn-block btn-categ"> Agregar</button>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <input class="btn btn-block btn-categ" type="reset" value="limpiar">
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </form>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
              </div>
              <!-- fin tabla añadir categorias -->

              <!-- tabla accion categorias -->
              <div class="col-12 col-md-6">
                <div class="card pt-0">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="" class="table table-borderless text-center dt-responsive text-center" cellspacing="0" width="100%">
                        <thead>
                          <tr style="background-color:#737BF1;">
                            <th style="border-radius: 10px 0 0 10px;">
                              nombre de categoría
                            </th>
                            <th style="border-radius:0 10px 10px 0;">
                              acción
                            </th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php
                          $pdo3 = Database::connect();

                          $sqlz = "SELECT * FROM categorias order by idCategoria DESC";
                          $qz = $pdo3->prepare($sqlz);
                          $qz->execute();

                          $contar = $qz->rowCount();
                          $cantidad_paginas = 3;
                          $page = $contar / $cantidad_paginas;
                          $page = ceil($page);

                          if (isset($_GET['pag'])) {
                            $pagina = $_GET['pag'];
                          } else {
                            $pagina = 1;
                          }

                          if ($contar > 0) {
                            if ($pagina > $page || $pagina < 1) {
                              header('Location:user-sidebar.php?pag=1');
                            }
                          }
                          $inicio = ($pagina - 1) * $cantidad_paginas;

                          $sql3 = "SELECT * FROM categorias order by idCategoria DESC LIMIT $inicio,$cantidad_paginas";
                          $q3 = $pdo3->prepare($sql3);
                          $q3->execute();


                          while ($dato3 = $q3->fetch(PDO::FETCH_ASSOC)) {
                          ?>
                            <tr>
                              <td>
                                <input type="text" value="<?php echo $dato3['nombreCategoria'] ?>" aria-label="Recipient's username with two button addons" style="text-align:center;border:0;background:none;" disabled>
                              </td>
                              <td>
                                <!--para editar categoría-->
                                <div class="btn-group" role="group">
                                  <a>
                                    <button class="btn btn-edit" nombre="categoria_editar" type="button" data-toggle="modal" data-target="#ModalCategoria<?php echo $dato3['idCategoria']; ?>">
                                      <i class='fas fa-edit'></i></button>
                                  </a>
                                </div>
                                <!-- para quitar categoría -->
                                <!--
                                <div class="btn-group" role="group">
                                  <a id="eliminar_categoria" href="#" data-id="<?php echo $dato3['idCategoria'] ?>">
                                    <button class="btn btn-quitar" type="button">
                                      <i class="fas fa-trash-alt"></i></button>
                                  </a>
                                </div>
                                -->

                                <!--/----------------------------------------MODAL EDITAR ---------------------------------------------------->
                                <div class="modal fade" id="ModalCategoria<?php echo $dato3['idCategoria']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h4>Editar Categoría</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div>
                                        <form id="formCatEditar" method="post" action="includes/categorias/checkEditCateg.php">

                                          <div class="modal-body ">

                                            <input type="text" id="idCategoria" name="idCategoria" class="form-control" value="<?php echo $dato3['idCategoria']; ?>" style="display: none;" />
                                            <div class="form-group" style="padding: 0px;">
                                              <label class="col-form-label">CATEGORÍA</label>
                                              <input type="text" placeholder="Categoria" id="nombreCategoria" name="nombreCategoria" class="form-control" value="<?php echo $dato3['nombreCategoria']; ?>" required />
                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                              </td>
                            </tr>
                          <?php
                          }
                          Database::disconnect();
                          ?>
                        </tbody>
                      </table>
                      <!-- paginador de categorías-->
                      <div class="col-12">
                        <div class="row pag">
                          <nav>
                            <ul class="pagination mt-3">
                              <li class="page-item <?php if ($pagina <= 1) echo 'disabled' ?>">
                                <a class="page-link text-info" href="user-sidebar.php?pag=<?php echo $pagina - 1; ?>">
                                  Anterior
                                </a>
                              </li>

                              <?php for ($i = 0; $i < $page; $i++) : ?>
                                <li class="page-item  <?php echo $pagina == $i + 1 ? 'activate' : '' ?>">
                                  <a class="page-link text-info num" href="user-sidebar.php?pag=<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a>
                                </li>
                              <?php endfor ?>

                              <li class="page-item <?php if ($pagina >= $page) echo 'disabled' ?>">
                                <a class="page-link text-info" href="user-sidebar.php?pag=<?php echo $pagina + 1; ?>">Siguiente</a>
                              </li>

                            </ul>
                          </nav>
                        </div>
                      </div>
                      <!--fin paginador -->
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
              </div>
              <!-- tabla fin accion categorias -->

            </div>

          </div>
        </div>
        <!-- FIN DE TABLA DE CURSOS -->


        <?php
        $pdo10 = Database::connect();

        $sqlw = "SELECT * from usuarios as c INNER JOIN cursoinscrito as a ON a.usuario_id=c.id_user WHERE c.privilegio=4";
        $qw = $pdo10->prepare($sqlw);
        $qw->execute();

        $contar = $qw->rowCount();

        $idProfesor = $_SESSION['codUsuario'];
        $sql10 = "SELECT * from usuarios as c INNER JOIN cursoinscrito as a ON a.usuario_id=c.id_user WHERE c.privilegio=4";
        $q10 = $pdo10->prepare($sql10);
        $q10->execute();
        $curso = $q10->fetchAll(PDO::FETCH_ASSOC);

        ?>


        <!-- para listar y la paginacion de usuarios -->
        <?php
        $pdo11 = Database::connect();
        $sql10 = "SELECT * FROM usuarios as c inner join cursoinscrito as a on a.usuario_id=c.id_user where c.privilegio=4 order by c.id_user DESC";
        $q10 = $pdo11->prepare($sql10);
        $q10->execute();
        $usuarios = $q10->fetchAll(PDO::FETCH_ASSOC);
        ?>

      </div>
    </div>
    </div>

    <br>
    <br>
    <br>

  </main>

  <!-- <script src="./assets/js/Validator.js"></script>
<script src="./assets/js/sidebarEditar.js"></script> -->

  <script>
    function cambiarImg() {
      var pdrs = document.getElementById('inputGroupFile04').files[0].name;
      document.getElementById('infoImg').innerHTML = pdrs;
    }

    function masInfoUser(x) {
      document.getElementById("Nombre").value = "";
      document.getElementById("Apellidop").value = "";
      document.getElementById("Apellidom").value = "";
      document.getElementById("Pais").value = "";
      document.getElementById("Correo").value = "";
      document.getElementById("Telefono").value = "";
      document.getElementById("Tipod").value = "";
      document.getElementById("Numero").value = "";
      document.getElementById("Tipos").value = "";
      document.getElementById("Fecha").value = "";

      //mensaje de espera

      $.ajax({
        url: "includes/usersidebar/actualizar_perfil.php",
        type: "POST",
        data: "cod_user=" + x,
        dataType: 'json',
        cache: false,
        success: function(arr) {

          document.getElementById("Nombre").value = arr[0];
          document.getElementById("Apellidop").value = arr[1];
          document.getElementById("Apellidom").value = arr[2];
          document.getElementById("Pais").value = arr[3];
          document.getElementById("Correo").value = arr[4];
          document.getElementById("Telefono").value = arr[5];
          document.getElementById("Tipod").value = arr[6];
          document.getElementById("Numero").value = arr[7];
          document.getElementById("Tipos").value = arr[8];
          document.getElementById("Fecha").value = arr[9];
          document.getElementById("id_userV").value = arr[10];
        },

      });
    }

    function actualizarUser() {
      var cod_user = document.getElementById('id_userV').value;
      var nombre_user = document.getElementById('Nombre').value;
      var userPaterno = document.getElementById('Apellidop').value;
      var userMaterno = document.getElementById('Apellidom').value;
      var userPais = document.getElementById('Pais').value;
      var correoUser = document.getElementById('Correo').value;
      var telefUser = document.getElementById('Telefono').value;
      var tipo_doc_user = document.getElementById("Tipod").value;
      var num_docUser = document.getElementById("Numero").value;
      var sexoUser = document.getElementById('Tipos').value;
      var nacimientoUser = document.getElementById('Fecha').value;
      // var imagenUser = document.getElementById('inputGroupFile04').value;
      // var fileToUpload = $('#inputGroupFile04').prop('files')[0];
      // var fileToUpload = document.getElementById('inputGroupFile04').prop('files')[0];


      Swal.fire({
        title: '¿SEGURO QUE DESEA ACTUALIZAR ESTE REGISTRO?',
        text: "Se actualizarán los datos de este Usuario",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Actualizar',
        cancelButtonText: 'Cancelar !'
      }).then(function() {
        $.ajax({
          url: "includes/usersidebar/actualizar_perfil.php",
          type: "POST",
          dataType: 'json',
          data: {
            id_usuario: cod_user,
            tipo_docUser: tipo_doc_user,
            numdoc_user: num_docUser,
            nombre_user: nombre_user,
            apellido_p_user: userPaterno,
            apellido_m_user: userMaterno,
            correo_user: correoUser,
            fecha_nac_user: nacimientoUser,
            sexo_user: sexoUser,
            telefono_user: telefUser,
            pais_user: userPais
          },
          cache: false
        }).done(function() {
          Swal.fire({
            title: 'Usuario Actualizado',
            text: 'Se han actualizado los datos satisfactoriamente.',
            icon: 'success',
          }).then(function() {
            location.reload();
          });

        }).fail(function() {
          Swal.fire({
            title: 'Error',
            text: 'Ocurrio un problama al actualizar el usuario',
            icon: 'error',
          }).then(function() {
            location.reload();
          });
        })
      }, function(dismiss) {
        if (dismiss === 'cancel') {}
      })
    }
  </script>

  <script>
    function masInfoUser(x) {
      document.getElementById("id_sol").value = "";
      document.getElementById("status").value = "";
      document.getElementById("nameC").value = "";
      document.getElementById("nameE").value = "";
      document.getElementById("E-C").value = "";
      document.getElementById("E-E").value = "";
      document.getElementById("T-C").value = "";
      document.getElementById("N-S").value = "";
      // document.getElementById("Pass").value = "";
      document.getElementById("F-S").value = "";
      // document.getElementById("Code").value = "";


      //mensaje de espera

      $.ajax({
        url: "includes/Business/business.php",
        type: "POST",
        data: "cod_user=" + x,
        dataType: 'json',
        cache: false,
        success: function(arr) {

          document.getElementById("id_sol").value = arr[0];
          document.getElementById("status").value = arr[1];
          document.getElementById("nameC").value = arr[2];
          document.getElementById("nameE").value = arr[3];
          document.getElementById("E-C").value = arr[4];
          document.getElementById("E-E").value = arr[5];
          document.getElementById("T-C").value = arr[6];
          document.getElementById("N-S").value = arr[7];
          // document.getElementById("Pass").value = arr[8];
          document.getElementById("F-S").value = arr[8];
          // document.getElementById("Code").value = arr[10];
          document.getElementById("id_user").value = arr[9];
        },

      });
    }

    function actu() {

      var cod_user = document.getElementById('id_user').value;
      var nameC = document.getElementById('nameC').value;
      var nameE = document.getElementById('nameE').value;
      var EmailC = document.getElementById('E-C').value;
      var EmailE = document.getElementById('E-E').value;
      var TelfC = document.getElementById('T-C').value;
      var subs = document.getElementById('N-S').value;
      var curseIns = document.getElementById('C-i').value;
      // var  = document.getElementById('F-S').value;
      var Pass = document.getElementById('Pass').value;
      var id_sol = document.getElementById('id_sol').value;
      // var PassC = document.getElementById('PassC').value;
      var codeCurse = document.getElementById('Code').value;
      var status = document.getElementById('status').value;

      // alert(cod_user+" "+nameC+" "+nameE+" "+EmailC+" "+EmailE+" "+TelfC+" "+subs+" "+curseIns+" "+Pass+" "+id_sol+" "+codeCurse+" "+status+" ");
      Swal.fire({
          title: '¿SEGURO QUE DESEA ACTUALIZAR ESTE REGISTRO DE EMPRESA?',
          text: "Se actualizarán los datos de esta empresa",
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Actualizar',
          cancelButtonText: 'Cancelar !'
        })
        .then(function() {
          $.ajax({
            url: "includes\Business\business.php",
            method: "POST",
            dataType: 'json',
            data: {
              id_usuario: cod_user,
              id_sol: id_sol,
              nameC: nameC,
              nameE: nameE,
              EmailC: EmailC,
              EmailE: EmailE,
              TelfC: TelfC,
              subs: subs,
              curseIns: curseIns,
              Pass: Pass,
              status: status,
              codeCurse: codeCurse
            },
            cache: false
          }).done(function() {
            Swal.fire({
              title: 'Usuario Actualizado',
              text: 'Se han actualizado los datos satisfactoriamente.',
              icon: 'success',
            }).then(function() {
              location.reload();
            });

          }).fail(function() {
            Swal.fire({
              title: 'Error',
              text: 'Ocurrio un problema al actualizar el usuario',
              icon: 'error',
            }).then(function() {
              location.reload();
            });
          })
        }, function(dismiss) {
          if (dismiss === 'cancel') {}
        })
    }
  </script>

  <script>

  </script>

<?php
} else {
  header('Location: ../../iniciosesion.php');
}
?>