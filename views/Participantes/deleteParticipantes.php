<form role="form" method="POST">
              <div class="box-body">
<?php 
require_once "../../class/Participantes.php";
               $codigo=$_POST["id_participantes"];
               $nombre_actividad=$_POST["nombre_actividad"];
               $id_actividad=$_POST["id_actividad"];
					     $actividads = new Participante();
                         $dato = $actividads->selectOne($codigo);
                        
                      foreach ((array)$dato as $row) {
                         		echo '

                            <label>¿Desea eliminar al participante <strong> '.$row['nombre'].'</strong>, de la actividad: <strong> '.$nombre_actividad.'</strong>? Se eliminara toda la informacion ingresada de esta hoja de asistencia</label>
                          <input type="hidden" name="id" id="id_ParticipanteEliminar" value="'.$row['id_participante'].'"/>  
                          <input type="hidden" name="id" id="id_actividad" value="'.$id_actividad.'"/>  
                          <input type="hidden" name="id" id="id_hoja_asistencia" value="'.$row['id_hoja_asistencia'].'"/>  
                          <input type="hidden" name="id" id="nombre_actividad" value="'.$nombre_actividad.'"/>  
                             ';}
?>
      </div>
              <div class="box-footer">
                <input type="button" class="btn btn-primary" id="eliminar" name="submit" value="Confirmar" >
                <input type="button" class="btn btn-danger" onClick="location.href = '../list/Participantes.php'" name="cancel" value="Cancelar" >
              </div>
            </form>
            <script>
document.getElementById('eliminar').addEventListener('click', eliminarInformacion);
                      function eliminarInformacion(){
                        var id_participante=document.getElementById('id_ParticipanteEliminar').value;
                        var nombre_actividad=document.getElementById('nombre_actividad').value;
                        var id_actividad=document.getElementById('id_actividad').value;
                        var id_hoja_asistencia=document.getElementById('id_hoja_asistencia').value;
                        console.log('Datos: ');
                      $.ajax({  
                            url:"../controladores/participantesControlador.php?accion=eliminar",  
                            method:"POST",  
                            data:{id_participante:id_participante,id_actividad:id_actividad,nombre_actividad:nombre_actividad,id_hoja_asistencia:id_hoja_asistencia},  
                            success:function(data){  
                                console.log(data);
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