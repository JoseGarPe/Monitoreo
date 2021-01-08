<!-- Modal -->
<?php
    //--------------------------------------------//
    $id_actividad = $_POST['id_Actividad'];
    require_once "../../class/Actividad.php";
    $actividads = new Actividad();
    $listUsua = $actividads->selectOne($id_actividad);
    foreach ($listUsua as $value) {
?>

         <form id="updateactividad" method="post">
          <input type="hidden" name="id_actividad" id="id_actividad" value="<?php echo $id_actividad?>">
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre</label>
                <input type="text" class="form-control" id="nombreActualizar" name="nombre" value="<?php echo $value['nombre']?>" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">Nombre Actividad.</small>
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
                        var id_actividad=document.getElementById('id_actividad').value;
                        console.log('Datos: ');
                       console.log('nombre: '+nombre);
                       console.log('id_actividad: '+id_actividad);
                      $.ajax({  
                            url:"../controladores/actividadControlador.php?accion=modificar",  
                            method:"POST",  
                            data:{id_actividad:id_actividad,nombre:nombre},  
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