<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Haz click en "Cerrar Sesion" para salir de la sesion actual.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button class="btn btn-danger" type="button" id="cerrarSesion">Cerrar Sesion</button>
        </div>
      </div>
    </div>
  </div>
<script>

document.getElementById('cerrarSesion').addEventListener('click', logout);
                      function logout(){
                        var accion='cerrar';
                        $.ajax({  
                            url:"../controladores/usuarioControlador.php?accion=logout",  
                            method:"POST",  
                            data:{accion:accion},  
                            success:function(data){  
                                      var array = JSON.parse(data);
                                      if (array.type == "success") {
                                        alertaLogout(array.tittle, "<h4>"+array.text+"</h4>", array.type, array.url);
                                      }else{
                                        alerta(array.tittle, "<h4>"+array.text+"</h4>", array.type);
                                      }
                            }  
                         });  
                      }
                      function alertaLogout(titulo, texto, tipo, url){
    Swal.fire({
      title: titulo, 
      html: texto, 
      icon: tipo, 
      confirmButtonText: '<a style="color:white;" href="http://localhost/Monitoreo/'+url+'">Aceptar</a>', 
      allowOutsideClick: false,
      allowEscapeKey: false})
  }
</script>
