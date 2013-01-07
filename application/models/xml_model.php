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
class xml_model extends CI_Model {

   
    /**
     *  Funcion Constructor del controlador, se realizan cargas de 
     * algunos modelos y helpers usuados en el funcionamiento de 
     * el controlador 
     *  
     * @category	Controller
     */
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url','xml'));
        $this->load->library('session');
        $this->load->model('usuario_model');
        $this->load->model('nota_model');
        $this->load->model('adjunto_model');
        $this->load->model("nota_adjunto_model");
    }
    
  
   public  function exportarprueba(){
         
         $data= "hola como estas";
         $dataxml=xml_convert($data);
         
         return $dataxml;
     }
    
    
}