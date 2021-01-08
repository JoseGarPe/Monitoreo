<?php
//--------------------------------------------//
session_start();
if (!isset($_SESSION['logged-in']) || $_SESSION['logged-in']==false ) {
  header('Location: ../login.php');
}
$id_actividad=$_GET['actividad'];
$nombre_actividad=$_GET['nombre_actividad'];
require_once "../class/Hojas_Asistencia.php";
$Hoja_Asistencias = new Hoja_Asistencia();
$ListHojasAsis = $Hoja_Asistencias->selectALL_Actividad ($id_actividad);

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sistema de Monitore y Seguimiento</title>

  <!-- Custom fonts for this template -->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
  
  <link href="../css/sweetalert2.css" rel="stylesheet" />

  <!-- Custom styles for this page -->
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
   
    <?php include_once 'menu.php';?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <form class="form-inline">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>
          </form>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
           

            <!-- Nav Item - Messages -->
            

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['Username'];?></span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Mantenimiento Hoja_Asistencias de la actividad <?php echo $nombre_actividad; ?></h1>
          <p class="mb-4">Administracion de Hojas de Asistencias, Creacion y modificacion</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Hojas de Asistencias Existentes de la actividad  <?php echo $nombre_actividad; ?></h6>
            </br>
              <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#staticBackdrop">
                    <span class="icon text-white-50">
                      <i class="fas fa-user"></i>
                    </span>
                    <span class="text">Agregar Hojas de Asistencias de la actividad  <?php echo $nombre_actividad; ?></span>
                  </a>
            </div>
            <div class="card-body">
              
              <!-- tabla de Hoja_Asistencias -->

              <div class="table-responsive">
              <input type="hidden" name="id_actividad" id="id_actividad" value="<?php echo $id_actividad;?>">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Actividad</th>
                      <th>Feha</th>
                      <th>Hora</th>
                      <th>Estado</th>
                      <th>Participantes</th>
                      <th>Finalizar</th>                      
                      <th>Editar</th>
                      <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                    foreach ($ListHojasAsis as $dato) {
                      $link = $link="Participantes.php?actividad=".$id_actividad."&nombre_actividad=".$nombre_actividad."&hoja_asistencia=".$dato['id_hoja_asistencia'];
                      ?>

                      <tr>
                      <td> <?php echo $dato['id_hoja_asistencia']; ?> </td>
                      <td> <?php echo $dato['actividad']; ?> </td>
                      <td><?php echo $dato['fecha']; ?></td>
                      <td><?php echo $dato['hora']; ?></td>
                      <td><?php echo $dato['estado']; ?> </td>
                      <td><a class="btn btn-primary" href="<?php echo $link;?>">Participantes</a></td>
                      <td><input type="button" name="status" value="Cambiar Estado" nombre_actividad="<?php echo $nombre_actividad?>" id_Hoja_Asistencia="<?php echo $dato["id_hoja_asistencia"]?>" class="btn btn-outline-success status_data" /></td>
                      <td><input type="button" name="edit" value="Editar" nombre_actividad="<?php echo $nombre_actividad?>" id_Hoja_Asistencia="<?php echo $dato["id_hoja_asistencia"]?>" class="btn btn-warning update_data" /></td>
                      <td>
                         <div class="btn-toolbar" role="toolbar">
                          <button type="button"  name="edit" value="Eliminar" nombre_actividad="<?php echo $nombre_actividad?>" id_Hoja_Asistencia="<?php echo $dato["id_hoja_asistencia"]?>" class=" btn btn-danger delete_data" ><i class="fas fa-trash-alt"></i></button>
                         </div>
                      </td>
                      
                    </tr>

                      <?php
                    }

                    ?>      
                  </tbody>
                </table>
              </div>

              <!-- fin Tabla de Hoja_Asistencias -->




            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Sistema de Monitoreo y Seguimiento 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->

  <?php include_once 'logout.php'?>
  <!-- Modal agregar Hoja_Asistencias -->
<?php include_once '../views/Hoja_Asistencias/saveHoja_Asistencias.php'?>

<div id="dataModal3" class="modal fade">  
                                  <div class="modal-dialog">  
                                       <div class="modal-content">  
                                            <div class="modal-header">  
                                            </div>  
                                            <div class="modal-body" id="employee_forms3">  

                                            </div>  
                                            <div class="modal-footer">  
                                                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                                            </div>  
                                       </div>  
                                  </div>  
</div>
  <!-- Modal modificar Hoja_Asistencias -->

  <!-- Modal eliminar Hoja_Asistencias -->


  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/datatables-demo.js"></script>
   <script src="../js/sweetalert2.min.js"></script>
   <script src="../js/sweetAlert2.js"></script>
<script>
 $(document).ready(function(){  
      //------------------------------------------------------//
      $(document).on('click', '.update_data', function(){  
          var id_Hoja_Asistencia = $(this).attr("id_Hoja_Asistencia");  
          var nombre_actividad= $(this).attr("nombre_actividad");  
           if(id_Hoja_Asistencia != '')  
           {  
                $.ajax({  
                     url:"../views/Hoja_Asistencias/updateHoja_Asistencias.php",  
                     method:"POST",  
                     data:{id_Hoja_Asistencia:id_Hoja_Asistencia,nombre_actividad:nombre_actividad},  
                     success:function(data){  
                          $('#employee_forms3').html(data);  
                          $('#dataModal3').modal('show');  
                     }  
                });  
           }   
      }); 
      //------------------------------------------------------------//
      $(document).on('click', '.delete_data', function(){  
          var id_Hoja_Asistencia = $(this).attr("id_Hoja_Asistencia");  
          var nombre_actividad= $(this).attr("nombre_actividad");  
           if(id_Hoja_Asistencia != '')  
           {  
                $.ajax({  
                     url:"../views/Hoja_Asistencias/deleteHoja_Asistencias.php",  
                     method:"POST",  
                     data:{id_Hoja_Asistencia:id_Hoja_Asistencia,nombre_actividad:nombre_actividad},  
                     success:function(data){  
                          $('#employee_forms3').html(data);  
                          $('#dataModal3').modal('show');  
                     }  
                });  
           }   
      }); 
      //------------------------------------------------------------//
      $(document).on('click', '.status_data', function(){  
          var id_Hoja_Asistencia = $(this).attr("id_Hoja_Asistencia");  
          var nombre_actividad= $(this).attr("nombre_actividad");  
           if(id_Hoja_Asistencia != '')  
           {  
                $.ajax({  
                     url:"../views/Hoja_Asistencias/statusHoja_Asistencias.php",  
                     method:"POST",  
                     data:{id_Hoja_Asistencia:id_Hoja_Asistencia,nombre_actividad:nombre_actividad},  
                     success:function(data){  
                          $('#employee_forms3').html(data);  
                          $('#dataModal3').modal('show');  
                     }  
                });  
           }   
      }); 
      //------------------------------------------------------------//
    });
</script>
</body>

</html>
