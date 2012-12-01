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
 * @copyright	                Copyright (c) 2012, 
 * @filesource
 */
class Home extends CI_Controller {

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
        include_once(APPPATH . 'controllers/homeuser.php');
    }
    
    /**
     *  Funcion index() se realizan las 
     * llamadas basicas para la carga de una de las vistas 
     * que se estan linkeadas al controlador 
     *  
     * @category	Controller
     */
    function index() {

       
        $data = array();
        $data['messi'] = "";
        $data['head'] = '/includes/headhome';
        $data['main_content'] = 'home/home';
        $data['title'] = 'Evernote->Home';
        $this->load->view('/includes/templates', $data);
    }
    
    /**
     * Funcion index2() se realizan las 
     * llamadas basicas para la carga de una de las vistas 
     * que se estan linkeadas al controlador, se llama a esta vista 
     * que produce error de login 
     *  
     * @category	Controller
     */
    function index2() {

        $data = array();
        $data['messi'] = "<a id='error-title'></a>
        <script>
        new popUp('Wrong Password or Username', 
        {title: 'Oops', titleClass: 'anim error', 
        autoclose: '1000'});
        </script>";
        $this->session->unset_userdata('username');
        $data['head'] = '/includes/headhome';
        $data['main_content'] = 'home/home';
        $data['title'] = 'Evernote->Home';
        $this->load->view('/includes/templates', $data);
    }

    /**
     * Funcion index3() se realizan las 
     * llamadas basicas para la carga de una de las vistas 
     * que se estan linkeadas al controlador, se llama a esta vista 
     * y se que produce exito del login 
     *  
     * @category	Controller
     */
    function index3() {

        $data = array();
        $data['messi'] = "<a id='success-title'></a>
        <script>
        new popUp('Succesful Register ', 
        {title: 'WELCOME', titleClass: 'success', 
        autoclose: '1000'});
        </script>";
        $this->session->unset_userdata('username');
        $data['head'] = '/includes/headhome';
        $data['main_content'] = 'home/home';
        $data['title'] = 'Evernote->Home';
        $this->load->view('/includes/templates', $data);
    }

    /**
     * Funcion verifylogin() funcion encargada de verificar la informacion del 
     * usuario, mediante la llamada a la capa de modelo (usuario_model) 
     *  
     * @category	Controller
     */
    function verifylogin() {

       
        $username = $this->input->post('username_login');
        $password = $this->input->post('password_login');
        $booleano = $this->usuario_model->login($username, $password);
        if ($booleano) {
            $this->session->set_userdata('username', $username);
            redirect('/homeuser/index2');
        } else {
            log_message("error", "Problem LOGIN IN");
            $this->index2();
        }
    }
    /**
     * Funcion register() funcion encargada de registrar la informacion del 
     * usuario nuevo, mediante la llamada a la capa de modelo (usuario_model) 
     *  
     * @category	Controller
     */
    function register() {

        $name = $this->input->post('name_signup');
        $lastname = $this->input->post('lastname_signup');
        $username = $this->input->post('username_signup');
        $password = $this->input->post('pass_signup');
        $email = $this->input->post('email_signup');
        $booleano = $this->usuario_model->register($name, $lastname, 
        $username, $email, $password);
        if ($booleano == true) {
            $this->index3();
        } else
        // caso de gente repetido
            echo "esta repedito";
    }

}