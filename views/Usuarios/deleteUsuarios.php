<form role="form" method="POST">
              <div class="box-body">
<?php 
require_once "../../class/Usuario.php";
               $codigo=$_POST["id_usuario"];
					     $actividads = new Usuario();
                         $dato = $actividads->selectOne($codigo);
                        
                      foreach ((array)$dato as $row) {
                         		echo '

                            <label>¿Desea eliminar el usuario: <strong> '.$row['nombre'].'</strong>? Se eliminara toda la informacion ingresada de este usuario</label>
                          <input type="hidden" name="id" id="id_usuarioEliminar" value="'.$row['id_usuario'].'"/>  
                             ';}
?>
      </div>
              <div class="box-footer">
                <input type="button" class="btn btn-primary" id="eliminar" name="submit" value="Confirmar" >
                <input type="button" class="btn btn-danger" onClick="location.href = '../list/Usuarios.php'" name="cancel" value="Cancelar" >
              </div>
            </form>
            <script>
document.getElementById('eliminar').addEventListener('click', eliminarInformacion);
                      function eliminarInformacion(){
                        var id_usuario=document.getElementById('id_usuarioEliminar').value;
                        console.log('Datos: ');
                       console.log('id_usuario: '+id_usuario);
                      $.ajax({  
                            url:"http://localhost/Monitoreo/controladores/usuarioControlador.php?accion=eliminar",  
                            method:"POST",  
                            data:{id_usuario:id_usuario},  
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