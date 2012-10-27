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
        $data['upload']=$this->uploadUserDetail($username);
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
    
        $nombre = $this->input->post('name_signup');
        $apellido = $this->input->post('lastname_signup');
        $email = $this->input->post('email_signup');
        

        $booleano = $this->usuario_model->modificar($username,$nombre,$apellido,$email);
        
        if ($booleano == true) {
            redirect('/homeuser/index');
        } else
        // caso de gente repetido
            echo "esta repedito";
    }
    
    function uploadUserDetail($username) {
        $return = '';
        $usuario = new Usuario_Model();
        $usuario = $usuario->getUser($username);
        $nombre = $usuario->getName();
        $apellido = $usuario->getApellido();
        $email=$usuario->getEmail();

        $return = "<div>
                    <label>Name</label>
                    <input name='name_signup'  id='name_signup' type='text' class='form-poshytip' title='Enter your name' value='$nombre' />
                </div>
                <div>
                    <label>Lastname</label>
                    <input name='lastname_signup' id='lastname_signup' type='text' class='form-poshytip' title='Enter your lastname'  value='$apellido'/>
                </div>
                <div>
                    <label>Email</label>
                    <input name='email_signup'  id='email_signup' type='email' class='form-poshytip' title='Enter your email' value='$email' />
                </div>";
        return $return;
    }
    
    /**
 * Usuario 
 *
 * @category	Usuario
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/database/
 * @param 	username Determines if active record should be used or not
 *  		
 */
    function cambiarPassword($username) {
    
        $password = $this->input->post('pass_signup');
        $booleano = $this->usuario_model->cambiarClave($username,$password);
        
        if ($booleano == true) {
            redirect('/homeuser/index');
        } else
        // caso de gente repetido
            echo "esta repedito";
    }
    
   
    
    
    
    
}
