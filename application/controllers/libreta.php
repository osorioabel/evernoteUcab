<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class libreta extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
    }
    
     function index() {
          
         $data = array();
         $data['main_content']='login';
        
        
    }
    
    
    
    
}
