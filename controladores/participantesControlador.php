<?php 
require_once "../class/Participantes.php";
$accion=$_GET['accion'];
/*
id_participante
id_hoja_asistencia
id_centro
nombre
edad
*/
if ($accion=='guardar') {
 if (isset($_POST['nombre'])) {
 	$nombre=$_POST['nombre'];
 }else{
 	$nombre=NULL;
 }
 if (isset($_POST['edad'])) {
 	$edad=$_POST['edad'];
 }else{
 	$edad=NULL;
 }
 if (isset($_POST['id_centro'])) {
 	$id_centro=$_POST['id_centro'];
 }else{
 	$id_centro=NULL;
 }
 $hoja_asistencia=$_POST['id_hoja_asistencia'];
 
 $usua = new Participante();
 $usua->setNombre($nombre);
 $usua->setedad($edad);
 $usua->setId_centro($id_centro);
 $usua->setId_hoja_asistencia($hoja_asistencia);
 $save =$usua->save();

	if ($save==TRUE) {
	//	header('Location: ../list/Participantes.php?success=correcto');
	$informacion = [
		"tittle" => "Correcto",
		"text" => "Participante ".$_POST['nombre'].' guardado con exito',
		"type" => "success",
		"url" => "Participantes.php?actividad=".$_POST['id_actividad']."&nombre_actividad=".$_POST['nombre_actividad']."&hoja_asistencia=".$hoja_asistencia
	  ];
      echo json_encode($informacion);
	}else{
		//header('Location: ../list/Participantes.php?error=incorrecto');
	    			$informacion = [
						"tittle" => "Error",
						"text" => "No fue posible guardar el Participante, por favor verifique los datos y vuelva a intentarlo",
						"type" => "error",
					  ];
					  echo json_encode($informacion);
	}
}
elseif ($accion=='eliminar') {
    $id_Participante=$_POST['id_participante'];
    $usua = new Participante();
    $usua->setId_participante($id_Participante);
    $delete= $usua->delete();
    if ($delete==TRUE) {
		$informacion = [
			"tittle" => "Correcto",
			"text" => 'Participante  Eliminado con exito',
			"type" => "success",
			"url" => "Participantes.php?actividad=".$_POST['id_actividad']."&nombre_actividad=".$_POST['nombre_actividad']."&hoja_asistencia=".$_POST['id_hoja_asistencia']
		  ];
		  echo json_encode($informacion);
		}else{
			//header('Location: ../list/Participantes.php?error=incorrecto');
						$informacion = [
							"tittle" => "Error",
							"text" => "No fue posible Eliminar el Participante, por favor verifique los datos y vuelva a intentarlo",
							"type" => "error",
						  ];
						  echo json_encode($informacion);
		}
}
elseif($accion=="modificar") {
    if (isset($_POST['nombre'])) {
		$nombre=$_POST['nombre'];
	}else{
		$nombre=NULL;
	}
	if (isset($_POST['edad'])) {
		$edad=$_POST['edad'];
	}else{
		$edad=NULL;
	}    
    $usua = new Participante();
    $usua->setNombre($nombre);
    $usua->setedad($edad);
    $usua->setId_Participante($_POST['id_Participante']);
	$update=$usua->update();
	if ($update==true) {
		$informacion = [
			"tittle" => "Correcto",
			"text" => "Participante ".$_POST['nombre'].' actualizado con exito',
			"type" => "success",
            "url" => "Participantes.php?actividad=".$_POST['id_actividad']."&nombre_actividad=".$_POST['nombre_actividad']."&hoja_asistencia=".$_POST['id_hoja_asistencia']
		  ];
		  
		  echo json_encode($informacion);

	}else{
	    			$informacion = [
						"tittle" => "Error",
						"text" => "No fue posible actualizar el Participante, por favor verifique los datos y vuelva a intentarlo",
						"type" => "error",
					  ];
					  echo json_encode($informacion);  

	}
}

elseif ($accion=='consultaCE') {
    $codigo_ce=$_POST['codigo_ce'];
    $usua = new Participante();
    $datosCE = $usua->selectCE($codigo_ce);
    if (!empty($datosCE)) {
        foreach ($datosCE as $key ) {
           $nombre_ce=$key['nombre'];
           $id_ce=$key['id'];
        }
		$informacion = [
			"tittle" => "Correcto",
			"nombre_ce" => $nombre_ce,
			"id_ce" => $id_ce
		  ];
		  echo json_encode($informacion);
		}else{
			//header('Location: ../list/Participantes.php?error=incorrecto');
						$informacion = [
							"tittle" => "Error",
                            "nombre_ce" => '',
                            "id_ce" => ''
						  ];
						  echo json_encode($informacion);
		}
}
 ?>
