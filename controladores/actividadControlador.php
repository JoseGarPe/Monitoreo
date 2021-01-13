<?php 
require_once "../class/Actividad.php";
$accion=$_GET['accion'];
/*
id_actividad
nombre
username
*/
if ($accion=='guardar') {
 if (isset($_POST['nombre'])) {
 	$nombre=$_POST['nombre'];
 }else{
 	$nombre=NULL;
 }
 
 if (isset($_POST['id_usuario'])) {
	$id_usuario=$_POST['id_usuario'];
}else{
	$id_usuario=NULL;
}
 $estado=1;
 
 $usua = new Actividad();
 $usua->setNombre($nombre);
 $usua->setId_estado($estado);
 $usua->setId_usuario($id_usuario);
 $save =$usua->save();

	if ($save==TRUE) {
	//	header('Location: ../list/actividades.php?success=correcto');
	$informacion = [
		"tittle" => "Correcto",
		"text" => "actividad ".$_POST['nombre'].' guardado con exito',
		"type" => "success",
		"url" => "actividades.php"
	  ];
      echo json_encode($informacion);
	}else{
		//header('Location: ../list/actividades.php?error=incorrecto');
	    			$informacion = [
						"tittle" => "Error",
						"text" => "No fue posible guardar el actividad, por favor verifique los datos y vuelva a intentarlo",
						"type" => "error",
					  ];
					  echo json_encode($informacion);
	}
}
elseif ($accion=='eliminar') {
    $id_actividad=$_POST['id_actividad'];
    $usua = new Actividad();
    $usua->setId_actividad($id_actividad);
    $delete= $usua->delete();
    if ($delete==TRUE) {
		$informacion = [
			"tittle" => "Correcto",
			"text" => 'actividad  Eliminado con exito',
			"type" => "success",
			"url" => "actividades.php"
		  ];
		  echo json_encode($informacion);
		}else{
			//header('Location: ../list/actividades.php?error=incorrecto');
						$informacion = [
							"tittle" => "Error",
							"text" => "No fue posible Eliminar el actividad, por favor verifique los datos y vuelva a intentarlo",
							"type" => "error",
						  ];
						  echo json_encode($informacion);
		}
}
elseif ($accion=='status') {
	$id_actividad=$_POST['id_actividad'];
	if (isset($_POST['estado'])) {
		$estado=$_POST['estado'];
	}else{
		$estado=2;
	}
 $usua = new Actividad();
 $usua->setId_actividad($id_actividad);
 $usua->setId_estado($estado);
 $delete= $usua-> updateStatus();
 if ($delete==TRUE) {
		header('Location: ../list/actividades.php?success=correcto');
	}

}
elseif($accion=="modificar") {
    if (isset($_POST['nombre'])) {
		$nombre=$_POST['nombre'];
	}else{
		$nombre=NULL;
	}
   
    $usua = new Actividad();
    $usua->setNombre($nombre);
    $usua->setId_actividad($_POST['id_actividad']);
	$update=$usua->update();
	if ($update==true) {
		$informacion = [
			"tittle" => "Correcto",
			"text" => "actividad ".$_POST['nombre'].' actualizado con exito',
			"type" => "success",
			"url" => "actividades.php"
		  ];
		  
		  echo json_encode($informacion);

	}else{
	    			$informacion = [
						"tittle" => "Error",
						"text" => "No fue posible actualizar el actividad, por favor verifique los datos y vuelva a intentarlo",
						"type" => "error",
					  ];
					  echo json_encode($informacion);  

	}
}