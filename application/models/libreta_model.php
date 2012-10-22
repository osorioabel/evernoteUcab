<?php

class Libreta_Model extends CI_Model {

    private $id_libreta = '';
    private $nombre = '';
    private $descripcion = '';
    private $fecha = '';
    private $fk_usuario = '';

    function __construct() {
        parent::__construct();
        $this->load->helper('date');
        
    }

    function registerBook($username, $title,$descrip) {
        //$id =  $this->db->where('username',$username);
        $query = $this->db->query("select id_usuario from usuario where username = '$username'");
        $row2 = $query->row();
        $hoy = date("Y-m-d H:i:s");   
        $data = array(
            'fk_usuario' =>  $row2->id_usuario,
            'nombre' => $title,
            'descripcion' => $descrip,
            'fecha' => $hoy,    
        );
        $insert = $this->db->insert('libreta', $data);
        $insert2 = array();
        $insert2['error'] = $this->db->_error_message();
        if ($insert['error'] != '')
            return false;
        return true;
    }

    function modificarLibreta($username, $libreta, $titulolibreta, $descrip) {
        $data = array('nombre' => $libreta,
            'descripcion' => $descrip,
        );

        $query = $this->db->query("UPDATE libreta SET nombre = '$titulolibreta',descripcion ='$descrip' WHERE id_libreta = '$libreta'");


        //  if($this->db->_error_message())
        //  return false;

        return true;
    }

    function BorrarLibreta($username, $libreta2) {


        $query = $this->db->query("Delete from libreta where id_libreta = '$libreta2'");


        if ($this->db->_error_message())
            return false;

        return true;
    }

    public function tamListLibreta($username) {
        $query = $this->db->query("select l.id_libreta,l.nombre,l.descripcion,l.fecha from libreta l, usuario u where u.username = '$username' and u.id_usuario = l.fk_usuario");
        return $query->num_rows;
    }

    public function libretaAtIndex($index,$username) {
        $libreta = new Libreta_Model();
        $query = $this->db->query("select l.id_libreta,l.nombre,l.descripcion,l.fecha from libreta l, usuario u where  u.username = '$username' and u.id_usuario = l.fk_usuario");
            
            
            $row = $query->num_rows();
             $row2 = $query->row();
            for($i=0; $i<$row; $i++){
            
                
            
               if($index==$i){
               $libreta->setId_libreta($row2->id_libreta);
               $libreta->setNombre($row2->nombre);
               $libreta->setDescripcion($row2->descripcion);
               $libreta->setFecha($row2->fecha);
               }
             $row2=$query->next_row();  
            }
        

        return $libreta;
    }

    public function getId_libreta() {
        return $this->id_libreta;
    }

    public function setId_libreta($id_libreta) {
        $this->id_libreta = $id_libreta;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function getFk_usuario() {
        return $this->fk_usuario;
    }

    public function setFk_usuario($fk_usuario) {
        $this->fk_usuario = $fk_usuario;
    }

}

