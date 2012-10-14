<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class homeuser extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
    }
    
    public function index($username) {
        
        $data = array();
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/homeuser/homeuser';
        $data['username']=$username;
        
        //echo $data['main_content'];
        $data['title'] = 'Home Page User';
        $this->load->view('/includes/templates', $data);    
        
    }
    
    
    
    
    
}
