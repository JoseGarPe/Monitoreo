 //--------------------------------------------------------------------------------------------------------------------------//
  
 function alerta(titulo, texto, tipo){
    Swal.fire({
      title: titulo,
      html: '<div style="witdh=100%;">'+texto+"</div>", 
      icon: tipo, 
      confirmButtonText: 'Aceptar', 
      allowOutsideClick: false,
      allowEscapeKey: false})
  }
  
  function alertaEspecial(titulo, texto, tipo, url){
    Swal.fire({
      title: titulo, 
      html: texto, 
      icon: tipo, 
      confirmButtonText: '<a style="color:white;" href="http://localhost/Monitoreo/list/'+url+'">Aceptar</a>', 
      allowOutsideClick: false,
      allowEscapeKey: false})
  }
  
