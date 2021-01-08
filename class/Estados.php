<?php 
require_once "config/conexion.php";
class Estado extends conexion
{

private $id_estado;
private $nombre;

public function __construct()
{
    parent::__construct(); //Llamada al constructor de la clase padre conexion
    
        $this->nombre = "";
        $this->id_estado = "";

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
    	$query="INSERT INTO `estados`(`id_estado`, `nombre`) VALUES(NULL,'".$this->nombre."');";
    	$save=$this->db->query($query);
    	if ($save==true) {
            return true;
        }else {
            return false;
        }   
    }

     public function update()
    {
        $query="UPDATE estados SET nombre='".$this->nombre."' WHERE id_estado='".$this->id_estado."'";
        $update=$this->db->query($query);
        if ($update==true) {
            return true;
        }else {
            return false;
        }  
    }
    public function delete()
    {
       $query="DELETE FROM estados WHERE id_estado='".$this->id_estado."'"; 
       $delete=$this->db->query($query);
       if ($delete == true) {
        return true;
       }else{
        return false;
       }

    }
     public function selectALL()
    {
        $query="SELECT * FROM estados";
        $selectall=$this->db->query($query);
        $ListTipoUsuario=$selectall->fetch_all(MYSQLI_ASSOC);
        return $ListTipoUsuario;
    }
     public function selectOne($codigo)
    {
        $query="SELECT * FROM estados WHERE id_estado='".$codigo."'";
        $selectall=$this->db->query($query);
       $ListTipoUsuario=$selectall->fetch_all(MYSQLI_ASSOC);
        return $ListTipoUsuario;
    }

    


}
?>