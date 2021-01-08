<?php 
require_once "config/conexion.php";
class Acceso extends conexion
{
private $id_acceso;
private $nombre;
private $id_estado;

public function __construct()
{
	parent::__construct(); //Llamada al constructor de la clase padre conexion

        $this->id_acceso= "";
        $this->nombre = "";
        $this->id_estado = "";

}

 	public function getId_acceso() {
        return $this->id_acceso;
    }

    public function setId_acceso($id) {
        $this->id_acceso = $id;
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
    	$query="INSERT INTO `accesos`(`id_acceso`, `nombre`, `id_estado`) VALUES(NULL,'".$this->nombre."','".$this->id_estado."');";
    	$save=$this->db->query($query);
    	if ($save==true) {
            return true;
        }else {
            return false;
        }   
    }

     public function update()
    {
        $query="UPDATE accesos SET nombre='".$this->nombre."', id_estado='".$this->id_estado."' WHERE id_acceso='".$this->id_acceso."'";
        $update=$this->db->query($query);
        if ($update==true) {
            return true;
        }else {
            return false;
        }  
    }
    public function delete()
    {
       $query="DELETE FROM accesos WHERE id_acceso='".$this->id_acceso."'"; 
       $delete=$this->db->query($query);
       if ($delete == true) {
        return true;
       }else{
        return false;
       }

    }
     public function selectALL()
    {
        $query="SELECT * FROM accesos";
        $selectall=$this->db->query($query);
        $ListTipoUsuario=$selectall->fetch_all(MYSQLI_ASSOC);
        return $ListTipoUsuario;
    }
     public function selectOne($codigo)
    {
        $query="SELECT * FROM accesos WHERE id_acceso='".$codigo."'";
        $selectall=$this->db->query($query);
       $ListTipoUsuario=$selectall->fetch_all(MYSQLI_ASSOC);
        return $ListTipoUsuario;
    }

    


}
?>