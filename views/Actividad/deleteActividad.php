<form role="form" method="POST">
              <div class="box-body">
<?php 
require_once "../../class/Actividad.php";
               $codigo=$_POST["id_Actividad"];
					     $actividads = new Actividad();
                         $dato = $actividads->selectOne($codigo);
                        
                      foreach ((array)$dato as $row) {
                         		echo '

                            <label>¿Desea eliminar el actividad: <strong> '.$row['nombre'].'</strong>? Se eliminara toda la informacion ingresada de esta actividad</label>
                          <input type="hidden" name="id" id="id_actividadEliminar" value="'.$row['id_actividad'].'"/>  
                             ';}
?>
      </div>
              <div class="box-footer">
                <input type="button" class="btn btn-primary" id="eliminar" name="submit" value="Confirmar" >
                <input type="button" class="btn btn-danger" onClick="location.href = '../list/actividads.php'" name="cancel" value="Cancelar" >
              </div>
            </form>
            <script>
document.getElementById('eliminar').addEventListener('click', eliminarInformacion);
                      function eliminarInformacion(){
                        var id_actividad=document.getElementById('id_actividadEliminar').value;
                        console.log('Datos: ');
                       console.log('id_actividad: '+id_actividad);
                      $.ajax({  
                            url:"../controladores/actividadControlador.php?accion=eliminar",  
                            method:"POST",  
                            data:{id_actividad:id_actividad},  
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