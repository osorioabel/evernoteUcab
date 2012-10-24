<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Usuario extends CI_Controller{
    
         
   public function __construct() {
        parent::__construct();
        $this->load->model('usuario_model');
        $this->load->helper('form');
    }
    
    function loadModifyView($username){
        $data = array();
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = 'usuario/usuario_modificar';
        $data['title'] = 'Evernote->Modify';
        $data['username']=  $username;
        $this->load->view('/includes/templates', $data);
    }
    
     function loadChangePasswordView($username){
        $data = array();
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = 'usuario/usuario_password';
        $data['title'] = 'Evernote->Change Password';
         $data['username']=  $username;
        $this->load->view('/includes/templates', $data);
    }
    
     function loadDropboxConfigurationView($username){
        $data = array();
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = 'usuario/usuario_dropbox';
        $data['title'] = 'Evernote->Configurate Dropbox';
         $data['username']=  $username;
        $this->load->view('/includes/templates', $data);
    }
    
    
     function index($username,$opcion) {
         
         switch($opcion) {
        case 'modify':
        $this->loadModifyView($username);
        break;
        case 'changePassword':
        $this->loadChangePasswordView($username);
        break; 
        case 'configurateDropbox':
        $this->loadDropboxConfigurationView($username);
        break;    
            
        };
         
         
    }
    

    function modificar($username) {
    
        $nombre = $this->input->post('name_modify');
        $apellido = $this->input->post('lastname_modify');
        $email = $this->input->post('email_modify');
        

        $booleano = $this->usuario_model->modificar($username,$nombre, $apellido,$email);
        
        if ($booleano == true) {
            $this->index($username,'');
        } else
        // caso de gente repetido
            echo "esta repedito";
    }
    
    function cambiarPassword($username) {
    
        $password = $this->input->post('pass_signup');
        $booleano = $this->usuario_model->cambiarClave($username,$password);
        
        if ($booleano == true) {
            $this->index($username,'');
        } else
        // caso de gente repetido
            echo "esta repedito";
    }
    
    function guardarDatosDropbox($username) {
    
        $cuentadropbox = $this->input->post('email_signup');
        $passdropbox = $this->input->post('pass_signup');
        $booleano = $this->usuario_model->configuarDropbox($username,$cuentadropbox,$passdropbox);
        
        if ($booleano == true) {
            $this->index($username,'');
        } else
        // caso de gente repetido
            echo "esta repedito";
    }
    
    
    
    
}
