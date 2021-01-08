<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sistema de Monitoreo y Seguimiento</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="css/sweetalert2.css" rel="stylesheet" />

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Inicio de Sesion!</h1>
                  </div>
                  <form class="controladores/usuarioControlador.php?accion=login">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="correo" aria-describedby="emailHelp" placeholder="Usuario">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="contrasena" placeholder="Contraseña">
                    </div>
                    <button type="button" class="btn btn-primary btn-user btn-block" id="login">Iniciar Sesion</button>
                    <hr>
                  </form>
                  
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Olvide mi Contraseña</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="register.html">Escribe a Soporte Tecnico</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
   <script src="js/sweetalert2.min.js"></script>
   <script src="js/sweetAlert2.js"></script>
  <script>
  
document.getElementById('login').addEventListener('click', enviarInformacion);
                      function enviarInformacion(){
                        var correo=document.getElementById('correo').value;
                        var contrasena=document.getElementById('contrasena').value;
                        console.log('Datos: ');
                      $.ajax({  
                            url:"http://localhost/Monitoreo/controladores/usuarioControlador.php?accion=login",  
                            method:"POST",  
                            data:{correo:correo,contrasena:contrasena},  
                            success:function(data){  
                                      var array = JSON.parse(data);
                                      if (array.type == "success") {
                                        alertaLogin(array.tittle, "<h4>"+array.text+"</h4>", array.type, array.url);
                                      }else{
                                        alerta(array.tittle, "<h4>"+array.text+"</h4>", array.type);
                                      }
                            }  
                         });  
                      }
                      
  function alertaLogin(titulo, texto, tipo, url){
    Swal.fire({
      title: titulo, 
      html: texto, 
      icon: tipo, 
      confirmButtonText: '<a style="color:white;" href="http://localhost/Monitoreo/'+url+'">Aceptar</a>', 
      allowOutsideClick: false,
      allowEscapeKey: false})
  }
  </script>

</body>

</html>
