<form role="form" method="POST">
              <div class="box-body">
<?php 
require_once "../../class/Hojas_Asistencia.php";
               $codigo=$_POST["id_Hoja_Asistencia"];
               $nombre_actividad=$_POST["nombre_actividad"];
					     $actividads = new Hoja_Asistencia();
                         $dato = $actividads->selectOne($codigo);
                        
                      foreach ((array)$dato as $row) {
                         		echo '

                            <label>¿Desea eliminar la hoja de asistencia con fecha <strong> '.$row['fecha'].'</strong>, de la actividad: <strong> '.$nombre_actividad.'</strong>? Se eliminara toda la informacion ingresada de esta hoja de asistencia</label>
                          <input type="hidden" name="id" id="id_hoja_asistenciaEliminar" value="'.$row['id_hoja_asistencia'].'"/>  
                          <input type="hidden" name="id" id="id_actividad" value="'.$row['id_actividad'].'"/>  
                          <input type="hidden" name="id" id="nombre_actividad" value="'.$nombre_actividad.'"/>  
                             ';}
?>
      </div>
              <div class="box-footer">
                <input type="button" class="btn btn-primary" id="eliminar" name="submit" value="Confirmar" >
                <input type="button" class="btn btn-danger" onClick="location.href = '../list/hoja_asistencias.php'" name="cancel" value="Cancelar" >
              </div>
            </form>
            <script>
document.getElementById('eliminar').addEventListener('click', eliminarInformacion);
                      function eliminarInformacion(){
                        var id_hoja_asistencia=document.getElementById('id_hoja_asistenciaEliminar').value;
                        var nombre_actividad=document.getElementById('nombre_actividad').value;
                        var id_actividad=document.getElementById('id_actividad').value;
                        console.log('Datos: ');
                      $.ajax({  
                            url:"../controladores/hojaAsistenciaControlador.php?accion=eliminar",  
                            method:"POST",  
                            data:{id_hoja_asistencia:id_hoja_asistencia,id_actividad:id_actividad,nombre_actividad:nombre_actividad},  
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