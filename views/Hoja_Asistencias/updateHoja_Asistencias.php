<!-- Modal -->
<?php
    //--------------------------------------------//
    $id_hoja_asistencia = $_POST['id_Hoja_Asistencia'];
    require_once "../../class/Hojas_Asistencia.php";
    $Usuarios = new Hoja_Asistencia();
    $listUsua = $Usuarios->selectOne($id_hoja_asistencia);
    foreach ($listUsua as $value) {
?>

         <form id="updateUsuario" method="post">
            <div class="form-gropu">
                <label>Datos de la Actividad: <?php echo $_POST['nombre_actividad']; ?> </label>
                <input type="hidden" name="id_hoja_asistencia" id="id_hoja_asistencia" value="<?php echo $id_hoja_asistencia ?>">
                <input type="hidden" name="nombre_actividad" id="nombre_actividad" value="<?php echo $_POST['nombre_actividad']; ?>">
                <input type="hidden" name="id_actividad" id="id_actividad" value="<?php echo $value['id_actividad']?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Fecha</label>
                <input type="text" class="form-control" id="fechaActualizar" name="fecha" value="<?php echo $value['fecha']?>" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">Fecha en que se realizo o realizara la actividad.</small>
            </div>
            
            <div class="form-group">
                <label for="exampleInputEmail1">Hora</label>
                <input type="text" class="form-control" id="horaActualizar" name="hora" value="<?php echo $value['hora']?>" aria-describedby="horaHelp">
                <small id="horaHelp" class="form-text text-muted">Hora en que se realizo o realizara la actividad.</small>
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

                        var fecha=document.getElementById('fechaActualizar').value;
                        var hora=document.getElementById('horaActualizar').value;
                        var nombre_actividad=document.getElementById('nombre_actividad').value;
                        var id_actividad=document.getElementById('id_actividad').value;
                        var id_hoja_asistencia=document.getElementById('id_hoja_asistencia').value;
                        console.log('Datos: ');
                       console.log('fecha: '+fecha);
                       console.log('hora: '+hora);
                       console.log('id_hoja_asistencia: '+id_hoja_asistencia);
                      $.ajax({  
                            url:"../controladores/hojaAsistenciaControlador.php?accion=modificar",  
                            method:"POST",  
                            data:{id_hoja_asistencia:id_hoja_asistencia,fecha:fecha,hora:hora,nombre_actividad:nombre_actividad,id_actividad:id_actividad},  
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