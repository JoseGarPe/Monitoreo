<?php 
/*
id_hoja_asistencia
fecha
hora
id_usuario
id_estado
*/ 
require_once "config/conexion.php";
class Hoja_Asistencia extends Conexion
{
 private $id_hoja_asistencia;
 private $fecha;
 private $hora;
 private $id_actividad;
 private $id_usuario;
 private $id_estado;

 public function __construct()
	{
		  parent::__construct(); //Llamada al constructor de la clase padre

        $this->id_hoja_asistencia = "";
        $this->fecha = "";
        $this->hora = "";
        $this->id_actividad="";
        $this->id_usuario="";
        $this->id_estado="";
    }



	public function getId_hoja_asistencia() {
        return $this->id_hoja_asistencia;
    }

    public function setId_hoja_asistencia($id) {
        $this->id_hoja_asistencia = $id;
    }
    
    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function getHora() {
        return $this->hora;
    }

    public function setHora($hora) {
        $this->hora = $hora;
    }
    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }
    public function getId_estado() {
        return $this->id_estado;
    }

    public function setId_estado($id_estado) {
        $this->id_estado = $id_estado;
    }
    
    public function getId_actividad() {
        return $this->id_actividad;
    }

    public function setId_actividad($id_actividad) {
        $this->id_actividad = $id_actividad;
    }
  //---------------------Funciones----------------------------//
  public function save()
  {
      $query="INSERT INTO hoja_asistencia(id_hoja_asistencia,fecha,hora,id_usuario,id_estado,id_actividad)
              values(NULL,'".$this->fecha."','".$this->hora."','".$this->id_usuario."','".$this->id_estado."','".$this->id_actividad."');";
      $save=$this->db->query($query);
      if ($save==true) {
          return true;
      }else {
          
          return false;
      }   
  }
   public function update()
  {
      $query="UPDATE hoja_asistencia SET fecha='".$this->fecha."',hora='".$this->hora."' WHERE id_hoja_asistencia=".$this->id_hoja_asistencia."";
      $update=$this->db->query($query);
      if ($update==true) {
          return true;
      }else {
          return false;
      }  
  }

   public function updateStatus()
  {
      $query="UPDATE hoja_asistencia SET id_estado=".$this->id_estado." WHERE id_hoja_asistencia='".$this->id_hoja_asistencia."'";
      $update=$this->db->query($query);
      if ($update==true) {
          return true;
      }else {
          return false;
      }  
  }

  public function delete()
  {
     $query="DELETE FROM hoja_asistencia WHERE id_hoja_asistencia='".$this->id_hoja_asistencia."'"; 
     $delete=$this->db->query($query);
     if ($delete == true) {
      return true;
     }else{
      return false;
     }

  }
  public function selectALL()
  {
      $query="SELECT u.*, tu.nombre as actividad, e.nombre as estado FROM hoja_asistencia u, actividad tu, estados e WHERE u.id_actividad = tu.id_actividad AND u.id_estado = e.id_estado";
      $selectall=$this->db->query($query);
      $Listhoja_asistencias=$selectall->fetch_all(MYSQLI_ASSOC);
      return $Listhoja_asistencias;
  }
  
  public function selectOne($codigo)
  {
      $query="SELECT * FROM hoja_asistencia WHERE id_hoja_asistencia=".$codigo."";
      $selectall=$this->db->query($query);
      $Listhoja_asistencia=$selectall->fetch_all(MYSQLI_ASSOC);
      return $Listhoja_asistencia;
  }
  public function selectALL_Actividad($id_actividad)
  {
      $query="SELECT u.*, tu.nombre as actividad, e.nombre as estado FROM hoja_asistencia u, actividad tu,estados e WHERE u.id_actividad = tu.id_actividad AND u.id_estado = e.id_estado AND u.id_actividad=".$id_actividad."";
      $selectall=$this->db->query($query);
      $Listhoja_asistencias=$selectall->fetch_all(MYSQLI_ASSOC);
      return $Listhoja_asistencias;
  }
      //------------------------------------------------------------------//

 }
?>