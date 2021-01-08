<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Agregar Hoja de Asistencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form method="post">
            <div class="form-gropu">
                <label>Datos de la Actividad: <?php echo $nombre_actividad; ?> </label>
                <input type="hidden" name="id_actividad" id="id_actividad" value="<?php echo $id_actividad; ?>">
                <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $_SESSION['id_usuario']; ?>">
                <input type="hidden" name="nombre_actividad" id="nombre_actividad" value="<?php echo $nombre_actividad; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">Fecha que se realizo o realizara la actividad.</small>
            </div>
            
            <div class="form-group">
                <label for="exampleInputEmail1">Hora</label>
                <input type="time" class="form-control" id="hora" name="hora" aria-describedby="horaHelp">
                <small id="horaHelp" class="form-text text-muted">Hora que se realizo o realizara la actividad.</small>
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

                        var fecha=document.getElementById('fecha').value;
                        var hora=document.getElementById('hora').value;
                        var id_actividad=document.getElementById('id_actividad').value;
                        var id_usuario=document.getElementById('id_usuario').value;
                        var nombre_actividad=document.getElementById('nombre_actividad').value;

                        var formData = new FormData();
                        formData.append('fecha', fecha);
                        formData.append('hora', hora);
                        formData.append('id_actividad', id_actividad);
                        formData.append('nombre_actividad', nombre_actividad);
                        formData.append('id_usuario', id_usuario);
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
                        xhr.open("POST", "../controladores/hojaAsistenciaControlador.php?accion=guardar", true);
                        xhr.send(formData);
                      }
                       
</script>