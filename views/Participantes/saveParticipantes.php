<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Agregar Participante a la Hoja de Asistencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form method="post">
            <div class="form-gropu">
                <label>Datos Participante de la Actividad: <?php echo $nombre_actividad; ?> </label>
                <input type="hidden" name="id_actividad" id="id_actividad" value="<?php echo $id_actividad; ?>">
                <input type="hidden" name="id_hoja_asistencia" id="id_hoja_asistencia" value="<?php echo $id_hoja_asistencia; ?>">
                <input type="hidden" name="nombre_actividad" id="nombre_actividad" value="<?php echo $nombre_actividad; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">nombre del o la participante.</small>
            </div>
            
            <div class="form-group">
                <label for="exampleInputEmail1">Edad</label>
                <input type="text" class="form-control" id="edad" name="edad" aria-describedby="edadHelp">
                <small id="edadHelp" class="form-text text-muted">edad del o la participante.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Codigo Centro Educativo</label>
                <input type="text" class="form-control" id="codigo_ce" name="codigo_ce" aria-describedby="ceHelp">
                <small id="ceHelp" class="form-text text-muted">Codigo del centro educativo del que partcipa.</small>
            </div>
            
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre Centro Educativo</label>
                <input type="text" readonly class="form-control" required id="nombre_ce" name="nombre_ce" aria-describedby="ceHelp">
                <input type="hidden" name="id_centro" id="id_centro">
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
                        var edad=document.getElementById('edad').value;
                        var id_actividad=document.getElementById('id_actividad').value;
                        var id_centro=document.getElementById('id_centro').value;
                        var nombre_actividad=document.getElementById('nombre_actividad').value;
                        var id_hoja_asistencia=document.getElementById('id_hoja_asistencia').value;

                        var formData = new FormData();
                        formData.append('nombre', nombre);
                        formData.append('edad', edad);
                        formData.append('id_actividad', id_actividad);
                        formData.append('nombre_actividad', nombre_actividad);
                        formData.append('id_hoja_asistencia', id_actividad);
                        formData.append('id_centro', id_centro);
                        console.log(formData);
                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function(){
                          if (this.readyState == 4 && this.status == 200) {
                            /*
                              UNA VEZ VERIFICADA QUE NUESTRA PETICIÓN HAYA RESULTADO EXITOSA
                              MANDAMOS LOS DATOS AL END POINT PARA GUARDARLOS EN LA BASE DE DATOS
                            */
                            console.log(this.response);
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
                        xhr.open("POST", "../controladores/participantesControlador.php?accion=guardar", true);
                        xhr.send(formData);
                      }
   
                       
</script>