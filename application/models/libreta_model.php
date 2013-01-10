<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * EvernoteUcab
 *
 * An Cloud Computering, Cloud storage base web app 
 * for remeinders, Notebooks and MORE
 *
 * @package		EvernoteUcab
 * @author		Abel Osorio Hector Matheus Luis Tovar
 * @copyright	        Copyright (c) 2012, 
 * @filesource
 */
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

    /**
     * 
     *
     * Esta Funcion registerBook($username, $title, $descrip)
     * se encarga de registrar en la base de datos 
     * a un usuario
     * @category Modelo
     * @param	string	nombre del usuario
     * @param	string	titulo de la libreta
     * @param	string	cuerpo de la libreta
     * @return	boolean dice si actualizo o no 
     */
    function registerBook($username, $title, $descrip) {
        //$id =  $this->db->where('username',$username);
        $query = $this->db->query("select id_usuario from usuario where username = '$username'");
        $row2 = $query->row();
        $hoy = date("Y-m-d H:i:s");
        $data = array(
            'fk_usuario' => $row2->id_usuario,
            'nombre' => $title,
            'descripcion' => $descrip,
            'fecha' => $hoy,
        );
        $insert = $this->db->insert('libreta', $data);
        $insert2 = array();
        $insert2['error'] = $this->db->_error_message();
        if ($insert['error'] != '') {

            log_message("error", "Error Creation a NoteBook .. At registerBook in libreta Model");
            return false;
        }
        log_message("error", "Succesfull  Creation a NoteBook .. ");
        return true;
    }

    /**
     * 
     *
     * Esta Funcion modificarLibreta($username, $libreta, $titulolibreta, $descrip)
     * se encarga de registrar en la base de datos 
     * a un usuario
     * @category Modelo
     * @param	string	nombre del usuario
     * @param	string	id de la libreta
     * @param	string	titulo de la libreta
     * @param	string	descripcion de la libreta
     * 
     * @return	boolean dice si actualizo o no 
     */
    function modificarLibreta($username, $libreta, $titulolibreta, $descrip) {
        $data = array('nombre' => $libreta,
            'descripcion' => $descrip,
        );

        $query = $this->db->query("UPDATE libreta SET nombre = '$titulolibreta',descripcion ='$descrip' WHERE id_libreta = '$libreta'");
        log_message("error", "Succesfull  Modification of  a NoteBook .. ");
        return true;
    }

    /**
     * 
     *
     * Esta Funcion BorrarLibreta($username, $libreta2) 
     * se encarga de borrrar en la base de datos 
     * a una libreta
     * @category Modelo
     * @param	string	nombre del usuario
     * @param	string	id de la libreta
     * @return	boolean dice si actualizo o no 
     */
    function BorrarLibreta($username, $libreta2) {


        $query = $this->db->query("Delete from libreta where id_libreta = '$libreta2'");


        if ($this->db->_error_message()) {
            log_message("error", "Error  Deleting  of  a NoteBook .. ");
            return false;
        }
        return true;
    }

    /**
     * 
     *
     * Esta Funcion getlibreta($numeroRegistros, $inicio) 
     * se encarga de obtener la libreta
     * a una libreta
     * @category Modelo
     * @param	string	$numeroRegistros
     * @param	string	i$inicio
     * @return	la libreta
     */
    function getlibreta($numeroRegistros, $inicio,$username) {

        $this->db->limit($numeroRegistros, $inicio);
         $query = $this->db->query("select l.id_libreta,l.nombre,l.descripcion,l.fecha from libreta l, usuario u where u.username = '$username' and u.id_usuario = l.fk_usuario");
       
        return $query->result();
    }

    /**
     * 
     *
     * Esta Funcion getCantidad()
     * @category Modelo
     * @return	la cantidad de libretas que hay
     */
    function getCantidad() {

        return $this->db->count_all('libreta');
    }
    
    /**
     * Esta Funcion tamListLibreta($id) 
     * se encarga de contar cuantas libretas tiene un usuario en la base de datos 
     * 
     * @category Modelo
     * @param	string	nombre del usuario
     * @return	int dice cantidad de libretas que tiene el usuario
     */
    public function tamListLibreta($username) {
        $query = $this->db->query("select l.id_libreta,l.nombre,l.descripcion,l.fecha from libreta l, usuario u where u.username = '$username' and u.id_usuario = l.fk_usuario");
        return $query->num_rows;
    }

    /**
     * Esta Funcion libretaAtIndex($index, $id)
     * se encarga de contar devolver una libreta que
     *  tiene un usuario en la base de datos 
     * 
     * @category Modelo
     * @param	string	posicion en la lista de libretas del usuario
     * @param	string	nombre del usuario
     * @return	object una libreta
     */
    public function libretaAtIndex($index, $username) {
        $libreta = new Libreta_Model();
        $query = $this->db->query("select l.id_libreta,l.nombre,l.descripcion,l.fecha from libreta l, usuario u where  u.username = '$username' and u.id_usuario = l.fk_usuario");


        $row = $query->num_rows();
        $row2 = $query->row();
        for ($i = 0; $i < $row; $i++) {



            if ($index == $i) {
                $libreta->setId_libreta($row2->id_libreta);
                $libreta->setNombre($row2->nombre);
                $libreta->setDescripcion($row2->descripcion);
                $libreta->setFecha($row2->fecha);
            }
            $row2 = $query->next_row();
        }


        return $libreta;
    }

    /**
     * Esta Funcion libretaAtIndex2($index, $id)
     * se encarga de devolver una libreta en especifico
     *  que tiene un usuario en la base de datos 
     * 
     * @category Modelo
     * @param	string	posicion en la lista de libretas del usuario
     * @param	string	nombre del usuario
     * @return	object una libreta
     */
    public function libretaAtIndex2($index, $username) {
        $libreta = new Libreta_Model();
        $query = $this->db->query("select l.id_libreta,l.nombre,l.descripcion,l.fecha from libreta l, usuario u where  u.username = '$username' and u.id_usuario = l.fk_usuario and l.id_libreta='$index'");



        $row2 = $query->row();

        $libreta->setId_libreta($row2->id_libreta);
        $libreta->setNombre($row2->nombre);
        $libreta->setDescripcion($row2->descripcion);




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

