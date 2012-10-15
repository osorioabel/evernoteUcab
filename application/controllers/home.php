<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuario_model');
        $this->load->helper('form');
        include_once(APPPATH . 'controllers/homeuser.php');
    }

    function index() {

        $data = array();
         $data['messi'] = "";
        $data['head'] = '/includes/headhome';
        $data['main_content'] = 'home/home';
        $data['title'] = 'Evernote->Home';
        $this->load->view('/includes/templates', $data);
    }

    function index2() {

        $data = array();
        $data['messi'] = "<a id='error-title'></a>
    
        <script>
        new popUp('Username or Password incorrect .', 
        {title: 'Error', titleClass: 'anim error', 
        buttons: [{id: 0, label: 'Close', val: 'X'}]});
        </script>
        ";
        $data['head'] = '/includes/headhome';
        $data['main_content'] = 'home/home';
        $data['title'] = 'Evernote->Home';
        $this->load->view('/includes/templates', $data);
    }

    function verifylogin() {


        $username = $this->input->post('username_login');
        $password = $this->input->post('password_login');

        $booleano = $this->usuario_model->login($username, $password);

        if ($booleano) {

            $homeuser = new homeuser();
            $homeuser->index2($username, 1);
        } else {
            
            $this->index2();
            
        }
    }

    function register() {


        $name = $this->input->post('name_signup');
        $lastname = $this->input->post('lastname_signup');
        $username = $this->input->post('username_signup');
        $password = $this->input->post('pass_signup');
        $email = $this->input->post('email_signup');

        $booleano = $this->usuario_model->register($name, $lastname, $username, $email, $password);
        //echo $booleano;
        if ($booleano == true) {

            $this->index();
        } else
        // caso de gente repetido
            echo "esta repedito";
    }

}