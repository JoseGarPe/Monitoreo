<?php 
require_once "config/conexion.php";
class Actividad extends conexion
{
private $id_actividad;
private $nombre;
private $id_estado;

public function __construct()
{
	parent::__construct(); //Llamada al constructor de la clase padre conexion

        $this->id_actividad= "";
        $this->nombre = "";
        $this->id_estado = "";

}

 	public function getId_actividad() {
        return $this->id_actividad;
    }

    public function setId_actividad($id) {
        $this->id_actividad = $id;
    }
    
    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getId_estado() {
        return $this->id_estado;
    }

    public function setId_estado($id_estado) {
        $this->id_estado = $id_estado;
    }

public function save()
    {
    	$query="INSERT INTO `actividad`(`id_actividad`, `nombre`, `id_estado`) VALUES(NULL,'".$this->nombre."','".$this->id_estado."');";
    	$save=$this->db->query($query);
    	if ($save==true) {
            return true;
        }else {
            return false;
        }   
    }

     public function update()
    {
        $query="UPDATE actividad SET nombre='".$this->nombre."' WHERE id_actividad='".$this->id_actividad."'";
        $update=$this->db->query($query);
        if ($update==true) {
            return true;
        }else {
            return false;
        }  
    }
    public function delete()
    {
       $query="DELETE FROM actividad WHERE id_actividad='".$this->id_actividad."'"; 
       $delete=$this->db->query($query);
       if ($delete == true) {
        return true;
       }else{
        return false;
       }

    }
     public function selectALL()
    {
        $query="SELECT * FROM actividad";
        $selectall=$this->db->query($query);
        $ListTipoUsuario=$selectall->fetch_all(MYSQLI_ASSOC);
        return $ListTipoUsuario;
    }
     public function selectOne($codigo)
    {
        $query="SELECT * FROM actividad WHERE id_actividad='".$codigo."'";
        $selectall=$this->db->query($query);
       $ListTipoUsuario=$selectall->fetch_all(MYSQLI_ASSOC);
        return $ListTipoUsuario;
    }

    


}
?>