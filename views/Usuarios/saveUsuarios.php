<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Agregar Usuarios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">Nombre completo.</small>
            </div>
            
            <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="usernameHelp">
                <small id="usernameHelp" class="form-text text-muted">Nombre de usuario.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Correo</label>
                <input type="text" class="form-control" id="correo" name="correo" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">example@site.com.</small>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Contraseña</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena" aria-describedby="passwordHelp">
                <small id="passwordHelp" class="form-text text-muted">Debe contener 6-8 digitos, que comprendan entre Mayusculas y minusculas, numeros y caracteres especiales ["/","@","#","$","%"].</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Tipo de acceso</label>
                <select name="id_acceso" id="id_acceso" class="form-control">
                  <?php 
                     require_once "../class/Accesos.php";
                     $NivelA = new Acceso();
                     $ListUsua = $NivelA->selectALL();
                     foreach ((array)$ListUsua as $row) {
                      echo '<option value="'.$row['id_acceso'].'">'.$row['nombre'].'</option>';
                     }
                  ?>
                </select>
                </div>
            
        </form>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="buttom" id="guardar" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>


<script>
document.getElementById('guardar').addEventListener('click', enviarInformacion);
                      function enviarInformacion(){

                        var nombre=document.getElementById('nombre').value;
                        var username=document.getElementById('username').value;
                        var contrasena=document.getElementById('contrasena').value;
                        var correo=document.getElementById('correo').value;
                        var id_acceso=document.getElementById('id_acceso').value;

                        var formData = new FormData();
                        formData.append('nombre', nombre);
                        formData.append('username', username);
                        formData.append('contrasena', contrasena);
                        formData.append('correo', correo);
                        formData.append('id_acceso', id_acceso);
                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function(){
                          if (this.readyState == 4 && this.status == 200) {
                            /*
                              UNA VEZ VERIFICADA QUE NUESTRA PETICIÓN HAYA RESULTADO EXITOSA
                              MANDAMOS LOS DATOS AL END POINT PARA GUARDARLOS EN LA BASE DE DATOS
                            */
                              var array = JSON.parse(this.response);
                              if (array.type == "success") {
                                alertaEspecial(array.tittle, "<h4>"+array.text+"</h4>", array.type, array.url);
                              }else{
                                alerta(array.tittle, "<h4>"+array.text+"</h4>", array.type);
                              }
                          }
                        };
                        /*
                          DEFINIMOS EL TIPO DE METODO Y LA URL DEL END POINT ESPECIFICO
                          LUEGO MANDAMOS LOS HEADERS NECESARIOS PARA NUESTRA API
                          Y POR ULTIMO EN LA FUNCION SEND, MANDAMOS LOS DATOS NECESARIOS PARA QUE NOS RETORNE EL TOKE
                          EN ESTE CASO EL CLIENTE Y EL ID
                        */
                        //xhr.open("POST", "https://pruebafiado.000webhostapp.com/sitioWeb/php/controladores/variablesSesiones.php", true);
                        xhr.open("POST", "http://localhost/Monitoreo/controladores/usuarioControlador.php?accion=guardar", true);
                        xhr.send(formData);
                      }
                       
</script>