<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		EvernoteUcab
 * @author		Abel Osorio Hector Matheus Luis Tovar
 * @copyright	        Copyright (c) 2012, 
 * @filesource
 */


class adjunto extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
    }
    
 /**
 *  Esta Funcion realiza : 
 *  
 * @category	Controller
 * @param 	string  dice q usuario es 
 * @param 	bool	Determines if active record should be used or not
 * 
 */
     function index($string) {
          
         $data = array();
         $data['main_content']='login';
        
        
    }
    
    
    
}
