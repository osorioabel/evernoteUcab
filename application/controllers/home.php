<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller{
    

    public function __construct() {
        parent::__construct();
         $this->load->model('usuario_model');
         $this->load->helper('form');
    }
    
     function index() {
          
         
         $data = array();
         $data['head']='/includes/headhome';
         $data['main_content']='home/home';
         $data['title']='Evernote->Home';
         $this->load->view('/includes/templates', $data);
    }
    
    function islogin(){
        
        
        
    }
    
    function verifylogin(){
        
        
            $username = $this->input->post('username_login');
            $password = $this->input->post('password_login');
            
            $booleano = $this->usuario_model->login($username,$password);
            echo $booleano;
            if ($booleano==true){
                echo "ESTE PANA EXISTE";
            }
           
            else{
                echo "este pana no esta en la BD";
            }

    }
    
    
    function register(){
        
        
            $username = $this->input->post('username_signup');
            $password = $this->input->post('pass_signup');
            $email = $this->input->post('email_signup');
            $dropboxmail = $this->input->post('dropboxmail_signup');
            $dropboxpass = $this->input->post('dropboxpass_signup');
            
            
            $booleano = $this->usuario_model->register($username,$email,$password,$dropboxmail,$dropboxpass);
            echo $booleano;
            if ($booleano==true){
                echo "ESTE PANA AHORA EXISTE";
            }
           
            else{
                echo "este pana no SE PUSO EN LA BD";
            }

    }
    
    
    
    
}