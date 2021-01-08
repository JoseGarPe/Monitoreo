<!-- Modal -->
<?php
    //--------------------------------------------//
    $id_usuario = $_POST['id_usuario'];
    require_once "../../class/Usuario.php";
    $Usuarios = new Usuario();
    $listUsua = $Usuarios->selectOne($id_usuario);
    foreach ($listUsua as $value) {
?>

         <form id="updateUsuario" method="post">
          <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $id_usuario?>">
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre</label>
                <input type="text" class="form-control" id="nombreActualizar" name="nombre" value="<?php echo $value['nombre']?>" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">Nombre completo.</small>
            </div>
            
            <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input type="text" class="form-control" id="usernameActualizar" name="username" value="<?php echo $value['username']?>" aria-describedby="usernameHelp">
                <small id="usernameHelp" class="form-text text-muted">Nombre de usuario.</small>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Correo</label>
                <input type="text" class="form-control" id="correoActualizar" name="correoActualizar" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">example@site.com.</small>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Tipo de acceso</label>
                <select name="id_accesoActualizar" id="id_accesoActualizar" class="form-control">
                  <?php 
                     require_once "../../class/Accesos.php";
                     $NivelA = new Acceso();
                     $ListAccesos = $NivelA->selectALL();
                     foreach ((array)$ListAccesos as $row) {
                        if ($value['id_acceso']==$row['id_acceso']) {
                             echo '<option value="'.$row['id_acceso'].'" selected>'.$row['nombre'].'</option>';
                        }else{
                             echo '<option value="'.$row['id_acceso'].'">'.$row['nombre'].'</option>'; 
                        }
                     }
                  ?>
                </select>
                </div>
                <div class="form-group">
                  <input type="button" id="actualizar" class="btn btn-primary" value="Guardar">
                
                </div>
        </form>
 <?php
    }
?>

<script>
document.getElementById('actualizar').addEventListener('click', actualizarInformacion);
                      function actualizarInformacion(){

                        var nombre=document.getElementById('nombreActualizar').value;
                        var username=document.getElementById('usernameActualizar').value;
                        var correo=document.getElementById('correoActualizar').value;
                        var id_usuario=document.getElementById('id_usuario').value;
                        var id_acceso=document.getElementById('id_accesoActualizar').value;
                        console.log('Datos: ');
                       console.log('nombre: '+nombre);
                       console.log('username: '+username);
                       console.log('id_usuario: '+id_usuario);
                       console.log('acceso: '+id_acceso);
                      $.ajax({  
                            url:"http://localhost/Monitoreo/controladores/usuarioControlador.php?accion=modificar",  
                            method:"POST",  
                            data:{id_usuario:id_usuario,nombre:nombre,username:username,id_acceso:id_acceso,correo:correo},  
                            success:function(data){  
                                      var array = JSON.parse(data);
                                      if (array.type == "success") {
                                        alertaEspecial(array.tittle, "<h4>"+array.text+"</h4>", array.type, array.url);
                                      }else{
                                        alerta(array.tittle, "<h4>"+array.text+"</h4>", array.type);
                                      }
                            }  
                         });  
                      }
                       
</script> 