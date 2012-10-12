<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller{
    
    
     function index() {
          
         $data = array();
         $data['head']='/includes/headhome';
         $data['main_content']='contenido2';
         $data['title']='Evernote->Home';
         $this->load->view('/includes/templates', $data);
        
    }
    
}