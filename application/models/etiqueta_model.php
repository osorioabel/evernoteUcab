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
class Etiqueta_Model extends CI_Model {
    
    private $id_etiqueta= '';
    private $texto = '';
    
    
    
    function __construct() {
        parent::__construct();
        $this->load->helper('date');
    }
    
    /**
    * Esta Funcion tamListTag($username) 
    * se encarga de contar cuantos tag
     *  tiene  una nota
    * 
    *@category Modelo
    * @param	string	nombre del usuario
    * @return	int dice cantidad de tags que tiene el usuario
    */
     public function tamListTag($username) {
        $query = $this->db->query("select e.id_etiqueta,e.texto from etiqueta e");
        return $query->num_rows;
    }
    
    /**
    * Esta Funcion etiquetaAtIndex($username) 
    * se encarga de devolver una etiqueta en una posicion en especifico
     *  de  una nota
    * 
    *@category Modelo
    * @param	string	nombre del usuario
    * @return	Una etiqueta
    */
     public function etiquetaAtIndex($index) {
        $etiqueta = new Etiqueta_Model();
        $query = $this->db->query("select e.id_etiqueta,e.texto from etiqueta e");

        $row = $query->num_rows();
        $row2 = $query->row();
        for ($i = 0; $i < $row; $i++) {



            if ($index == $i) {
                $etiqueta->setId_etiqueta($row2->id_etiqueta);
               $etiqueta->setTexto($row2->texto);
            }
            $row2 = $query->next_row();
        }


        return $etiqueta;
    }
    
    
      /**
    * Esta Funcion createTag($content) 
    * se encarga crear un tag con un contenido en especifico
    * 
    *@category Modelo
    * @param	string	$content contenido del tag
    * @return	Una etiqueta creada
    */
    public function createTag($content)
    {
           $etiqueta = new Etiqueta_Model();
           
            $data = array(
            'texto' => $content,
        );
        $query = $this->db->insert('etiqueta', $data);
         $query2= $this->db->query("select id_etiqueta from etiqueta order by 1 desc ");
        $row2 = $query2->row();
           log_message("error", "Successfull Tag creation");
        return $row2->id_etiqueta;     
    }
     public function createTagWithID($id_etiqueta,$content)
    {
           $etiqueta = new Etiqueta_Model();
           
            $data = array(
             'id_etiqueta'  => $id_etiqueta, 
            'texto' => $content,
        );
        $query = $this->db->insert('etiqueta', $data);
         $query2= $this->db->query("select id_etiqueta from etiqueta order by 1 desc ");
        $row2 = $query2->row();
           log_message("error", "Successfull Tag creation");
        return $row2->id_etiqueta;     
    }

    
      /**
    * Esta Funcion getId_etiqueta() 
    * se encarga de devolver el id de la etiqueta
    * 
    *@category Modelo
    * @return	el id de de una etiqueta
    */
    public function getId_etiqueta() {
        return $this->id_etiqueta;
    }

    /**
    * Esta Funcion setId_etiqueta($id_etiqueta)
    * se encarga de setear el id de la etiqueta
     * @param	string	$id_etiquetat id del tag 
    *@category Modelo
    
    */
    public function setId_etiqueta($id_etiqueta) {
        $this->id_etiqueta = $id_etiqueta;
    }

      /**
    * Esta Funcion getTexto() 
    * se encarga de devolver el texto de la etiqueta
    * 
    *@category Modelo
    * @return  el texto de la etiqueta
    */
    public function getTexto() {
        return $this->texto;
    }

    /**
    * Esta Funcion setTexto($texto) 
    * se encarga de setear el texto de la etiqueta
    * @param string $texto texto de la etiqueta
    *@category Modelo
    
    */
    public function setTexto($texto) {
        $this->texto = $texto;
    }


    
}


