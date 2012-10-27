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
class etiqueta extends CI_Controller{
    
    
    public function __construct() {
        parent::__construct();
        
    }
    
     function index() {
          
         $data = array();
         $data['main_content']='login';
        
        
    }
    
    
    
    
}

