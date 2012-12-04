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
    
     public function tamListTag($username) {
        $query = $this->db->query("select e.id_etiqueta,e.texto from etiqueta e");
        return $query->num_rows;
    }
    
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
    
    public function createTag($content)
    {
           $etiqueta = new Etiqueta_Model();
           
            $data = array(
            'texto' => $nota,
        );
        $query = $this->db->insert('etiqueta', $data);
         $query2= $this->db->query("select max(id_etiqueta)  from etiqueta ");
        $row2 = $query2->row();
        return $row2->id_etiqueta;     
    }

    
    public function getId_etiqueta() {
        return $this->id_etiqueta;
    }

    public function setId_etiqueta($id_etiqueta) {
        $this->id_etiqueta = $id_etiqueta;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function setTexto($texto) {
        $this->texto = $texto;
    }


    
}


