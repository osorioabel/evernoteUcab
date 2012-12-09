<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
class Nota_Adjunto_Model extends CI_Model {
    
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
    function registeradjunto_nota($nota, $adjunto) {


        $hoy = date("Y-m-d H:i:s");
        $data = array(
            'fk_nota' => $nota,
            'fk_adjunto' => $adjunto,
            'fecha_adjunto'=> $hoy
        );
        $insert = $this->db->insert('nota_adjunto', $data);
        $insert2 = array();
        $insert2['error'] = $this->db->_error_message();
        if ($insert['error'] != '') {
            
            log_message("error", "Succesfull  registing a Attach in a NoteBook .. ");
            return false;
        }

        log_message("error", "Succesfull  Registing a  Attach in  a NoteBook .. ");
        return true;
    }

    
    
}


