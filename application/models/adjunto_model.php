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
class Adjunto_Model extends CI_Model {

    private $id_ajunto = '';
    private $nombre = '';
    private $link = '';

    function __construct() {
        parent::__construct();
    }

    /**
     * 
     *
     * Esta Funcion rregisteradjunto($link, $nombre)
     * se encarga de registrar en la base de datos 
     * un archivo adjunto
     * @category Modelo
     * @param	string	nombre del usuario
     * @param	string	titulo de la nota
     * @param	string	cuerpo de la nota
     * @param	string	libreta para asociar la nota
     * @return	boolean dice si actualizo o no 
     */
    function registeradjunto($link, $nombre) {


        $hoy = date("Y-m-d H:i:s");
        $data = array(
            'link' => $link,
            'nombre' => $nombre
        );
        $insert = $this->db->insert('adjunto', $data);
        $insert2 = array();
        $insert2['error'] = $this->db->_error_message();
        if ($insert['error'] != '') {
            return false;
            log_message("error", "Error Attaching a File");
        }

        log_message("error", "Attached Successful");
        return true;
    }
    
    function registeradjuntowithID($id_adjunto,$link, $nombre) {


        $hoy = date("Y-m-d H:i:s");
        $data = array(
            'id_adjunto' => $id_adjunto,
            'link' => $link,
            'nombre' => $nombre
        );
        $insert = $this->db->insert('adjunto', $data);
        $insert2 = array();
        $insert2['error'] = $this->db->_error_message();
        if ($insert['error'] != '') {
            return false;
            log_message("error", "Error Attaching a File");
        }

        log_message("error", "Attached Successful");
        return true;
    }
    
    /**
     * 
     *
     * Esta Funcion getMaxID()
     * se encarga de devolver el ultimo id
     * @category Modelo
     * @return devuelve el id del ultimo adjunto agregado
     */
      public function getMaxID(){
        $query= $this->db->query("select id_adjunto   from adjunto order by 1 desc");
        $row2 = $query->row();
        return $row2->id_adjunto;       
     }
     
     
      /**
     * 
     *
     * Esta Funcion getId_ajunto()
     * se encarga de devolver el id del adjunto
     * @category Modelo
     * @return devuelve el id del ultimo adjunto agregado
     */
    public function getId_ajunto() {
        return $this->id_ajunto;
    }

       /**
     * 
     *
     * Esta Funcion setId_ajunto()
     * se encarga setear el id del adjunto
     * @category Modelo
     * @param  Integer	id del adjunto
     
     */
    public function setId_ajunto($id_ajunto) {
        $this->id_ajunto = $id_ajunto;
    }
       /**
     * 
     *
     * Esta Funcion getNombre()
     * se encarga de devolver el nombre del adjunto
     * @category Modelo
     * @return devuelve el id del ultimo adjunto agregado
     */
    public function getNombre() {
        return $this->nombre;
    }
       /**
     * 
     *
     * Esta Funcion setNombre()
     * se encarga de setear el nombre
        @category Modelo
     * 
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
      /**
     * 
     *
     * Esta Funcion getLink()
     * se encarga de devolver el link
     * @category Modelo
     * @return devuelve el id del ultimo adjunto agregado
     */
    public function getLink() {
        return $this->link;
    }
      /**
     * 
     *
     * Esta Funcion setLink()
     * se encarga de setear el link
     * @category Modelo
     * 
     */
    public function setLink($link) {
        $this->link = $link;
    }


    
}

