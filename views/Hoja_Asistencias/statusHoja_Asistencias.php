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

                            <label>¿Desea cambiar de estado la hoja de asistencia con fecha <strong> '.$row['fecha'].'</strong>, de la actividad: <strong> '.$nombre_actividad.'</strong>?</label>
                          <input type="hidden" name="id" id="id_hoja_asistenciaEstado" value="'.$row['id_hoja_asistencia'].'"/>  
                          <input type="hidden" name="id" id="id_actividad" value="'.$row['id_actividad'].'"/>  
                          <input type="hidden" name="id" id="nombre_actividad" value="'.$nombre_actividad.'"/>  
                             ';
                           echo '  <div class="form-group">
                                <select id="id_estado">';
                                require_once "../../class/Estados.php";
                                $NivelA = new Estado();
                                $ListEstados = $NivelA->selectALL();
                                foreach ((array)$ListEstados as $data) {
                                    if ($row['id_estado']==$data['id_estado']) {
                                      echo '<option value="'.$data['id_estado'].'" selected>'.$data['nombre'].'</option>';  
                                    }else{
                                      echo '<option value="'.$data['id_estado'].'">'.$data['nombre'].'</option>';  
                                    }                                 
                                }
                           echo'</select>
                           </div>';
                            }
?>
      </div>
   
              <div class="box-footer">
                <input type="button" class="btn btn-primary" id="estado" name="submit" value="Confirmar" >
                <input type="button" class="btn btn-danger" onClick="location.href = '../list/hoja_asistencias.php'" name="cancel" value="Cancelar" >
              </div>
            </form>
            <script>
document.getElementById('estado').addEventListener('click', estadoInformacion);
                      function estadoInformacion(){
                        var id_hoja_asistencia=document.getElementById('id_hoja_asistenciaEstado').value;
                        var nombre_actividad=document.getElementById('nombre_actividad').value;
                        var id_actividad=document.getElementById('id_actividad').value;
                        var id_estado=document.getElementById('id_estado').value;
                        console.log('Datos: ');
                      $.ajax({  
                            url:"../controladores/hojaAsistenciaControlador.php?accion=status",  
                            method:"POST",  
                            data:{id_hoja_asistencia:id_hoja_asistencia,id_actividad:id_actividad,nombre_actividad:nombre_actividad,id_estado:id_estado},  
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