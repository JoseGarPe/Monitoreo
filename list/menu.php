    <?php 
    function url_actual(){
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
          $url = "https://"; 
        }else{
          $url = "http://"; 
        }
      //  echo $url . $_SERVER['HTTP_HOST'] .  $_SERVER['REQUEST_URI'];
      $enlace = $_SERVER['REQUEST_URI'];
      $arrayEnlace=explode('/',$enlace);
      $indice = array_search('list',$arrayEnlace,true);
      return $indice;  
     }
     
    ?>
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo (url_actual()!= null)?'../index.php':'index.php';?>">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Sistema de Actividades</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo (url_actual()!= null)? '../index.php':'index.php';?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Principal</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Administracion
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Mantenimiento</span>
        </a>
        <div id="collapseTwo" class="collapse show " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Escoja una Opcion</h6>

            <a class="collapse-item" href="<?php echo (url_actual()!= null)? 'usuarios.php':'list/usuarios.php';?>">Usuarios</a>
            <a class="collapse-item" href="<?php echo (url_actual()!= null)? 'Actividades.php':'list/Actividades.php';?>">Actividades</a>
          </div>
        </div>
      </li>

   

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
   
      </div>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>

    