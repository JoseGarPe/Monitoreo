<?php 
require_once "../class/Usuario.php";
$accion=$_GET['accion'];
/*
id_usuario
nombre
username
contrasena
id_acceso
id_estado

*/
if ($accion=='guardar') {
 if (isset($_POST['nombre'])) {
 	$nombre=$_POST['nombre'];
 }else{
 	$nombre=NULL;
 }
 if (isset($_POST['username'])) {
 	$username=$_POST['username'];
 }else{
 	$username=NULL;
 }
  if (isset($_POST['contrasena'])) {
 	$contrasena=$_POST['contrasena'];
 }else{
 	$contrasena=NULL;
 }

 if (isset($_POST['correo'])) {
	$correo=$_POST['correo'];
}else{
	$correo=NULL;
}

  if (isset($_POST['id_acceso'])) {
 	$id_acceso=$_POST['id_acceso'];
 }else{
 	$id_acceso=NULL;
 }
 $estado=1;
 
 $usua = new Usuario();
 $usua->setNombre($nombre);
 $usua->setUsername($username);
 $usua->setContrasena($contrasena);
 $usua->setCorreo($correo);
 $usua->setId_acceso($id_acceso);
 $usua->setId_estado($estado);
 $save =$usua->save();

	if ($save==TRUE) {
	//	header('Location: ../list/Usuarios.php?success=correcto');
	$informacion = [
		"tittle" => "Correcto",
		"text" => "Usuario ".$_POST['nombre'].' guardado con exito',
		"type" => "success",
		"url" => "usuarios.php"
	  ];
      echo json_encode($informacion);
	}else{
		//header('Location: ../list/Usuarios.php?error=incorrecto');
	    			$informacion = [
						"tittle" => "Error",
						"text" => "No fue posible guardar el usuario, por favor verifique los datos y vuelva a intentarlo",
						"type" => "error",
					  ];
					  echo json_encode($informacion);
	}
}
elseif ($accion=='eliminar') {
    $id_usuario=$_POST['id_usuario'];
    $usua = new Usuario();
    $usua->setId_usuario($id_usuario);
    $delete= $usua->delete();
    if ($delete==TRUE) {
		$informacion = [
			"tittle" => "Correcto",
			"text" => 'Usuario  Eliminado con exito',
			"type" => "success",
			"url" => "usuarios.php"
		  ];
		  echo json_encode($informacion);
		}else{
			//header('Location: ../list/Usuarios.php?error=incorrecto');
						$informacion = [
							"tittle" => "Error",
							"text" => "No fue posible Eliminar el usuario, por favor verifique los datos y vuelva a intentarlo",
							"type" => "error",
						  ];
						  echo json_encode($informacion);
		}
}
elseif ($accion=='status') {
	$id_usuario=$_POST['id_usuario'];
	if (isset($_POST['estado'])) {
		$estado=$_POST['estado'];
	}else{
		$estado=2;
	}
 $usua = new Usuario();
 $usua->setId_usuario($id_usuario);
 $usua->setId_estado($estado);
 $delete= $usua-> updateStatus();
 if ($delete==TRUE) {
		header('Location: ../list/Usuarios.php?success=correcto');
	}

}
elseif($accion=="modificar") {
    if (isset($_POST['nombre'])) {
		$nombre=$_POST['nombre'];
	}else{
		$nombre=NULL;
	}
	if (isset($_POST['username'])) {
		$username=$_POST['username'];
	}else{
		$username=NULL;
	} 
	if (isset($_POST['correo'])) {
		$correo=$_POST['correo'];
	}else{
		$username=NULL;
	} 
	 if (isset($_POST['id_acceso'])) {
		$id_acceso=$_POST['id_acceso'];
	}else{
		$id_acceso=3;
	}
   
    $usua = new Usuario();
    $usua->setNombre($nombre);
    $usua->setUsername($username);
    $usua->setCorreo($Correo);
    $usua->setId_acceso($id_acceso);
    $usua->setId_usuario($_POST['id_usuario']);
    $usua->setCorreo($correo);
	$update=$usua->update();
	if ($update==true) {
		$informacion = [
			"tittle" => "Correcto",
			"text" => "Usuario ".$_POST['nombre'].' actualizado con exito',
			"type" => "success",
			"url" => "usuarios.php"
		  ];
		  
		  echo json_encode($informacion);

	}else{
	    			$informacion = [
						"tittle" => "Error",
						"text" => "No fue posible actualizar el usuario, por favor verifique los datos y vuelva a intentarlo",
						"type" => "error",
					  ];
					  echo json_encode($informacion);  

	}
}
elseif($accion=='login') {
	if (isset($_POST['correo'])) {
		$correo=$_POST['correo'];
		if (isset($_POST['contrasena'])) {
			$contrasena=$_POST['contrasena'];
			$usua = new Usuario();
			$usua->setCorreo($correo);
			$usua->setContrasena($contrasena);
			$login=$usua->login();
			if ($login==true) {
				$informacion = [
					"tittle" => "Correcto",
					"text" => "Bienvenido",
					"type" => "success",
					"url" => "index.php"
				];
				echo json_encode($informacion);
			}else{
							$informacion = [
								"tittle" => "Error",
								"text" => "Usuario no registrado, por favor registrate o intenta de nuevo.",
								"type" => "error",
							];
				echo json_encode($informacion);  
			}
		}else{
			$informacion = [
				"tittle" => "Error",
				"text" => "Contraseña invalida",
				"type" => "error",
			  ];
			  echo json_encode($informacion);  
		}	
	}else{
		$informacion = [
			"tittle" => "Error",
			"text" => "Es necesario un correo electronico para poder ingresar",
			"type" => "error",
		  ];
		  echo json_encode($informacion);  
	}	
}
elseif ($accion=='logout') {
	session_start();
	session_destroy();
	//llenamos la sesion logged-in como false
	session_start();
	$_SESSION['logged-in']=false;

	$informacion = [
		"tittle" => "Correcto",
		"text" => "Hasta la proxima",
		"type" => "success",
		"url" => "login.php"
	];
	echo json_encode($informacion);
}
 ?>
