<?php 
/*
id_usuario
nombre
username
contrasena
id_acceso
id_estado
*/ 
require_once "config/conexion.php";
class Usuario extends Conexion
{
 private $id_usuario;
 private $nombre;
 private $username;
 private $contrasena;
 private $correo;
 private $id_acceso;
 private $id_estado;

 public function __construct()
	{
		  parent::__construct(); //Llamada al constructor de la clase padre

        $this->id_usuario = "";
        $this->nombre = "";
        $this->username = "";
        $this->contrasena="";
        $this->correo="";
        $this->id_acceso="";
        $this->id_estado="";
    }



	public function getId_usuario() {
        return $this->id_usuario;
    }

    public function setId_usuario($id) {
        $this->id_usuario = $id;
    }
    
    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getContrasena() {
        return $this->contrasena;
    }

    public function setContrasena($contrasena) {
        $password = hash('sha256', $contrasena);  
        $this->contrasena = $password;
    }
    public function getId_acceso() {
        return $this->id_acceso;
    }

    public function setId_acceso($id_acceso) {
        $this->id_acceso = $id_acceso;
    }
    public function getId_estado() {
        return $this->id_estado;
    }

    public function setId_estado($id_estado) {
        $this->id_estado = $id_estado;
    }
    
    public function getCorreo() {
        return $this->correo;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }
  //---------------------Funciones----------------------------//
  public function save()
  {
      $query="INSERT INTO usuarios (id_usuario,nombre,username,contrasena,id_acceso,id_estado,correo)
              values(NULL,'".$this->nombre."','".$this->username."','".$this->contrasena."','".$this->id_acceso."','".$this->id_estado."','".$this->correo."');";
      $save=$this->db->query($query);
      if ($save==true) {
          return true;
      }else {
          
          return false;
      }   
  }
   public function update()
  {
      $query="UPDATE usuarios SET nombre='".$this->nombre."',username='".$this->username."',id_acceso=".$this->id_acceso.", correo='".$this->correo."' WHERE id_usuario=".$this->id_usuario."";
      $update=$this->db->query($query);
      if ($update==true) {
          return true;
      }else {
          return false;
      }  
  }

   public function updateStatus()
  {
      $query="UPDATE usuarios SET id_estado=".$this->id_estado." WHERE id_usuario='".$this->id_usuario."'";
      $update=$this->db->query($query);
      if ($update==true) {
          return true;
      }else {
          return false;
      }  
  }

  public function delete()
  {
     $query="DELETE FROM usuarios WHERE id_usuario='".$this->id_usuario."'"; 
     $delete=$this->db->query($query);
     if ($delete == true) {
      return true;
     }else{
      return false;
     }

  }
  public function selectALL()
  {
      $query="SELECT u.*, tu.nombre as tipo_usuario FROM usuarios u, accesos tu WHERE u.id_acceso = tu.id_acceso";
      $selectall=$this->db->query($query);
      $ListUsuarios=$selectall->fetch_all(MYSQLI_ASSOC);
      return $ListUsuarios;
  }
  
  public function selectOne($codigo)
  {
      $query="SELECT * FROM usuarios WHERE id_usuario=".$codigo."";
      $selectall=$this->db->query($query);
      $ListUsuario=$selectall->fetch_all(MYSQLI_ASSOC);
      return $ListUsuario;
  }
  public function login(){
      $query1="SELECT u.*, tu.nombre as tipo FROM usuarios u INNER JOIN accesos tu ON tu.id_acceso=u.id_acceso WHERE correo='".$this->correo."' AND contrasena='".$this->contrasena."' AND u.id_estado=1";
      $selectall1=$this->db->query($query1);
      $ListUsuario=$selectall1->fetch_all(MYSQLI_ASSOC);

      if ($selectall1->num_rows!=0) {
          foreach ($ListUsuario as $key) {
              session_start();
              $_SESSION['logged-in'] = true;
              $_SESSION['Username']= $key['username'];
              $_SESSION['id_usuario']=$key['id_usuario'];
              $_SESSION['Acceso']=$key['id_acceso'];
              $_SESSION['tipo']=$key['tipo'];
              $_SESSION['tiempo']=time();
          }
           return true;
      }else{
              $_SESSION['logged-in'] = false;
               $_SESSION['tiempo']=0;
              return false;
          }
          
      }
      //------------------------------------------------------------------//

 }
?>