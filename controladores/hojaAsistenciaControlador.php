<?php 
require_once "../class/Hojas_Asistencia.php";
$accion=$_GET['accion'];
/*
id_hoja_asistencia
fecha
hora
id_actividad
id_usuario
id_estado
*/
if ($accion=='guardar') {
 if (isset($_POST['fecha'])) {
 	$fecha=$_POST['fecha'];
 }else{
 	$fecha=NULL;
 }
 if (isset($_POST['hora'])) {
 	$hora=$_POST['hora'];
 }else{
 	$hora=NULL;
 }

 if (isset($_POST['id_actividad'])) {
	$id_actividad=$_POST['id_actividad'];
}else{
	$id_actividad=NULL;
}

  if (isset($_POST['id_usuario'])) {
 	$id_usuario=$_POST['id_usuario'];
 }else{
 	$id_usuario=NULL;
 }
 $estado=1;
 
 $hojaAsis = new Hoja_Asistencia();
 $hojaAsis->setFecha($fecha);
 $hojaAsis->setHora($hora);
 $hojaAsis->setId_actividad($id_actividad);
 $hojaAsis->setId_usuario($id_usuario);
 $hojaAsis->setId_estado($estado);
 $save =$hojaAsis->save();

	if ($save==TRUE) {
	//	header('Location: ../list/Hoja_Asistencias.php?success=correcto');
	$informacion = [
		"tittle" => "Correcto",
		"text" => "Hoja de Asistencia, con fecha :".$_POST['fecha'].' guardado con exito',
		"type" => "success",
		"url" => "Hoja_Asistencias.php?actividad=".$id_actividad."&nombre_actividad=".$_POST['nombre_actividad']
	  ];
      echo json_encode($informacion);
	}else{
		//header('Location: ../list/Hoja_Asistencias.php?error=incorrecto');
	    			$informacion = [
						"tittle" => "Error",
						"text" => "No fue posible guardar el Hoja_Asistencia, por favor verifique los datos y vuelva a intentarlo",
						"type" => "error",
					  ];
					  echo json_encode($informacion);
	}
}
elseif ($accion=='eliminar') {
    $id_Hoja_Asistencia=$_POST['id_hoja_asistencia'];
    $hojaAsis = new Hoja_Asistencia();
    $hojaAsis->setId_hoja_asistencia($id_Hoja_Asistencia);
    $delete= $hojaAsis->delete();
    if ($delete==TRUE) {
		$informacion = [
			"tittle" => "Correcto",
			"text" => 'Hoja_Asistencia  Eliminado con exito',
			"type" => "success",
			"url" => "Hoja_Asistencias.php?actividad=".$_POST['id_actividad']."&nombre_actividad=".$_POST['nombre_actividad']
		  ];
		  echo json_encode($informacion);
		}else{
			//header('Location: ../list/Hoja_Asistencias.php?error=incorrecto');
						$informacion = [
							"tittle" => "Error",
							"text" => "No fue posible Eliminar la Hoja de Asistencia, por favor verifique los datos y vuelva a intentarlo",
							"type" => "error",
						  ];
						  echo json_encode($informacion);
		}
}
elseif ($accion=='status') {
	$id_Hoja_Asistencia=$_POST['id_hoja_asistencia'];
	if (isset($_POST['id_estado'])) {
		$estado=$_POST['id_estado'];
	}else{
		$estado=2;
	}
 $hojaAsis = new Hoja_Asistencia();
 $hojaAsis->setId_hoja_asistencia($id_Hoja_Asistencia);
 $hojaAsis->setId_estado($estado);
 $delete= $hojaAsis-> updateStatus();
 if ($delete==TRUE) {
	$informacion = [
		"tittle" => "Correcto",
		"text" => 'Hoja_Asistencia  Eliminado con exito',
		"type" => "success",
		"url" => "Hoja_Asistencias.php?actividad=".$_POST['id_actividad']."&nombre_actividad=".$_POST['nombre_actividad']
	  ];
	  echo json_encode($informacion);
	}else{
		$informacion = [
			"tittle" => "Error",
			"text" => "No fue posible Eliminar la Hoja de Asistencia, por favor verifique los datos y vuelva a intentarlo",
			"type" => "error",
		  ];
		  echo json_encode($informacion);
	}

}
elseif($accion=="modificar") {
    if (isset($_POST['fecha'])) {
		$fecha=$_POST['fecha'];
	}else{
		$fecha=NULL;
	}
	if (isset($_POST['hora'])) {
		$hora=$_POST['hora'];
	}else{
		$hora=NULL;
	} 
	if (isset($_POST['id_actividad'])) {
		$id_actividad=$_POST['id_actividad'];
	}else{
		$hora=NULL;
	} 
   
    $hojaAsis = new Hoja_Asistencia();
    $hojaAsis->setFecha($fecha);
    $hojaAsis->setHora($hora);
    $hojaAsis->setId_hoja_asistencia($_POST['id_hoja_asistencia']);
	$update=$hojaAsis->update();
	if ($update==true) {
		$informacion = [
			"tittle" => "Correcto",
			"text" => "Hoja de Asistencia con fecha: ".$_POST['fecha'].' actualizado con exito',
			"type" => "success",
			"url" => "Hoja_Asistencias.php?actividad=".$id_actividad."&nombre_actividad=".$_POST['nombre_actividad']
		  ];
		  
		  echo json_encode($informacion);

	}else{
	    			$informacion = [
						"tittle" => "Error",
						"text" => "No fue posible actualizar la Hoja de Asistencia, por favor verifique los datos y vuelva a intentarlo",
						"type" => "error",
					  ];
					  echo json_encode($informacion);  

	}
}
 ?>
