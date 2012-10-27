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



        $data = array(
            'link' => $link,
            'nombre' => $nombre
        );
        $insert = $this->db->insert('adjunto', $data);
        $insert2 = array();
        $insert2['error'] = $this->db->_error_message();
        if ($insert['error'] != '') {
            return false;
        }

        //$query2 = $this->db->query("SELECT * FROM adjunto order by 1 desc;");
        //$row = $query2->num_rows();
        //$row2 = $query2->row();
        //$lastadjunto=$row2->id_adjunto;
        
        
        
        return true;
    }

    public function getId_ajunto() {
        return $this->id_ajunto;
    }

    public function setId_ajunto($id_ajunto) {
        $this->id_ajunto = $id_ajunto;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getLink() {
        return $this->link;
    }

    public function setLink($link) {
        $this->link = $link;
    }


    
}

