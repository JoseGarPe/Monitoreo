<?php 
/*
id_participante
id_hoja_asistencia
id_centro
nombre
edad
*/ 
require_once "config/conexion.php";
class Participante extends Conexion
{
 private $id_participante;
 private $nombre;
 private $edad;
 private $id_hoja_asistencia;
 private $id_centro;
 private $genero;
 public function __construct()
	{
		  parent::__construct(); //Llamada al constructor de la clase padre

        $this->id_participante = "";
        $this->nombre = "";
        $this->edad = "";
        $this->id_hoja_asistencia="";
        $this->id_centro="";
        $this->genero ="";
    }



	public function getId_participante() {
        return $this->id_participante;
    }

    public function setId_participante($id) {
        $this->id_participante = $id;
    }
    
    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getEdad() {
        return $this->edad;
    }

    public function setEdad($edad) {
        $this->edad = $edad;
    }

    public function getId_hoja_asistencia() {
        return $this->id_hoja_asistencia;
    }

    public function setId_hoja_asistencia($id_hoja_asistencia) {
        $this->id_hoja_asistencia = $id_hoja_asistencia;
    }
    public function getId_centro() {
        return $this->id_centro;
    }

    public function setId_centro($id_centro) {
        $this->id_centro = $id_centro;
    }
     public function getGenero() {
        return $this->genero;
    }

    public function setGenero($genero) {
        $this->genero = $genero;
    }
  //---------------------Funciones----------------------------//
  public function save()
  {
      $query="INSERT INTO participantes (id_participante,nombre,edad,id_hoja_asistencia,id_centro,genero)
              values(NULL,'".$this->nombre."','".$this->edad."','".$this->id_hoja_asistencia."','".$this->id_centro."','".$this->genero."');";
      $save=$this->db->query($query);
      if ($save==true) {
          return true;
      }else {
          
          return false;
      }   
  }
   public function update()
  {
      $query="UPDATE participantes SET nombre='".$this->nombre."',edad='".$this->edad."',genero='".$this->genero."' WHERE id_participante=".$this->id_participante."";
      $update=$this->db->query($query);
      if ($update==true) {
          return true;
      }else {
          return false;
      }  
  }


  public function delete()
  {
     $query="DELETE FROM participantes WHERE id_participante='".$this->id_participante."'"; 
     $delete=$this->db->query($query);
     if ($delete == true) {
      return true;
     }else{
      return false;
     }

  }
  public function selectALL($id_hoja_asistencia)
  {
      $query="SELECT u.*, c.nombre as ce,c.codigo as code,d.departamento as depa , m.municipio as muni FROM participantes u, t_centros_educativos c, t_departamentos d,t_municipios m WHERE u.id_centro = c.id AND c.id_municipiio = m.id AND m.id_depto = d.id AND u.id_hoja_asistencia=".$id_hoja_asistencia;
      $selectall=$this->db->query($query);
      $Listparticipantes=$selectall->fetch_all(MYSQLI_ASSOC);
      return $Listparticipantes;
  }
  
  public function selectOne($codigo)
  {
      $query="SELECT * FROM participantes WHERE id_participante=".$codigo."";
      $selectall=$this->db->query($query);
      $Listparticipante=$selectall->fetch_all(MYSQLI_ASSOC);
      return $Listparticipante;
  }
      //------------------------------------------------------------------//

      public function selectCE($codigo)
      {
          $query="SELECT * FROM t_centros_educativos WHERE codigo=".$codigo."";
          $selectall=$this->db->query($query);
          $Listparticipante=$selectall->fetch_all(MYSQLI_ASSOC);
          return $Listparticipante;
      }

 }
?>