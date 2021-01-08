<!-- Modal -->
<?php
    //--------------------------------------------//
    $id_Participante = $_POST['id_participantes'];
    require_once "../../class/Participantes.php";
    $Participantes = new Participante();
    $listUsua = $Participantes->selectOne($id_Participante);
    foreach ($listUsua as $value) {
?>

         <form id="updateParticipante" method="post">
          <input type="hidden" name="id_Participante" id="id_Participante" value="<?php echo $id_Participante?>">
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre</label>
                <input type="text" class="form-control" id="nombreActualizar" name="nombre" value="<?php echo $value['nombre']?>" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">Nombre Participante.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Edad</label>
                <input type="text" class="form-control" id="edadActualizar" name="edad" value="<?php echo $value['edad']?>" aria-describedby="edadHelp">
                <small id="edadHelp" class="form-text text-muted">Nombre Participante.</small>

                <input type="hidden" name="id_hoja_asistencia" id="id_hoja_asistencia" value="<?php echo $value['id_hoja_asistencia'] ?>">
                <input type="hidden" name="nombre_actividad" id="nombre_actividad" value="<?php echo $_POST['nombre_actividad']; ?>">
                <input type="hidden" name="id_actividad" id="id_actividad" value="<?php echo $_POST['id_actividad']?>">
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
                        var edad=document.getElementById('edadActualizar').value;
                        var id_actividad=document.getElementById('id_actividad').value;
                        var nombre_actividad=document.getElementById('nombre_actividad').value;
                        var id_hoja_asistencia=document.getElementById('id_hoja_asistencia').value;
                        var id_Participante=document.getElementById('id_Participante').value;
                        console.log('Datos: ');
                       console.log('nombre: '+nombre);
                       console.log('id_Participante: '+id_Participante);
                      $.ajax({  
                            url:"../controladores/participantesControlador.php?accion=modificar",  
                            method:"POST",  
                            data:{id_Participante:id_Participante,nombre:nombre,edad:edad,id_actividad:id_actividad,nombre_actividad:nombre_actividad,id_hoja_asistencia:id_hoja_asistencia},  
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