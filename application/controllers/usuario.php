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
class Usuario extends CI_Controller {

    /**
     *  Funcion Constructor del controlador, se realizan cargas de 
     * algunos modelos y helpers usuados en el funcionamiento de 
     * el controlador 
     *  
     * @category	Controller
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('usuario_model');
        $this->load->helper('form');
    }

    /**
     *  Funcion loadModifyView($username) se realizan las 
     * llamadas basicas para la carga de una de las vistas 
     * de modificacion de datos del usuario
     *  
     * @param       string $username usuario activo
     * @category    Controller
     */
    function loadModifyView($username) {
        $data = array();
        $data['head'] = '/includes/headnormal';
        // llamada a funcion para cargar los detalles del usuario en los input
        // de la interfaz
        $data['upload'] = $this->uploadUserDetail($username);
        $data['main_content'] = 'usuario/usuario_modificar';
        $data['title'] = 'Evernote->Modify';
        $data['username'] = $username;
        $this->load->view('/includes/templates', $data);
    }

    /**
     *  Funcion loadModifyView($username) se realizan las 
     * llamadas basicas para la carga de una de las vistas 
     * de modificacion de claves del usuario
     * 
     * @param      string $username usuario activo 
     * @categor    Controller
     */
    function loadChangePasswordView($username) {
        $data = array();
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = 'usuario/usuario_password';
        $data['title'] = 'Evernote->Change Password';
        $data['username'] = $username;
        $this->load->view('/includes/templates', $data);
    }

    /**
     *  Funcion index($username,$opcion) se realizan las 
     * llamadas basicas para la carga de una de las vistas 
     * de datos del usuario, segun sea el caso se llaman a los demas metodos
     *  
     * @category	Controller
     * @param string $username usuario 
     * @param string $opcion nombre de funcion index a llamar 
     */
    function index($username, $opcion) {

        switch ($opcion) {
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

    /**
     * Funcion modificar($username) funcion que se encarga 
     * de modificar datos al usuario. realizando llamada 
     * llamada al model encargadose el de dicha actividad
     * @category	Controller
     * @param           string $username usuario activo
     * 
     */
    function modificar($username) {

        $nombre = $this->input->post('name_signup');
        $apellido = $this->input->post('lastname_signup');
        $email = $this->input->post('email_signup');
        
        // se realiza llamada al model para que se modificquen los datos del usuario
        $booleano = $this->usuario_model->modificar($username, $nombre, $apellido, $email);
        if ($booleano == true) {
            // si se realizo la modificacion regresar al index
            redirect('/homeuser/index');
        } else
        // caso de gente repetido
            echo "esta repedito";
    }

    /**
     * Funcion uploadUserDetail($username) Esta funcion se encarga de 
     * preguntar a la capa de modelo, por los datos del usuario 
     * y crear HTML para mostrarlo en la vista en los input del
     * formulario
     *  
     * @category	Controller
     * @param 	        string usuario que se encuentra activo 
     * @return          string se devuelven a la vista HTLM para ser Impreso
     */
    function uploadUserDetail($username) {
        $return = '';
        $usuario = new Usuario_Model();
        $usuario = $this->usuario_model->getUser($username);
        $nombre = $this->usuario_model->getName();
        $apellido = $this->usuario_model->getApellido();
        $email = $this->usuario_model->getEmail();

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
     * Funcion cambiarPassword($username) funcion que se encarga 
     * de modificar claves al usuario. realizando llamada 
     * llamada al model encargadose el de dicha actividad
     * @category	Controller
     * @param           string $username usuario activo
     * 
     */
    function cambiarPassword($username) {

        $password = $this->input->post('pass_signup');
        // llamada al modelo para modificar clave
        $booleano = $this->usuario_model->cambiarClave($username, $password);

        if ($booleano == true) {
            // si el cambio fue exitoso se redirecciona
            redirect('/homeuser/index');
        } else
        // caso de gente repetido
            echo "esta repedito";
    }
    
    
    function test($username) {

      
        $booleano = $this->usuario_model->getUserToken($username);

        if ($booleano != null) {
            // si el cambio fue exitoso se redirecciona
            print_r($booleano);
        } else
        // caso de gente repetido
            echo "esta repedito";
    }
    
    
    

}
