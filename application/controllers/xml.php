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
class xml extends CI_Controller{
    
    
    public function __construct() {
        parent::__construct();
        $this->load->model('usuario_model');
        $this->load->helper('xml');
        
    }
    
       function index() {
          
           
          echo $this->usuario_model->getUserxml("osorioabel");
        
    }
    
    
}