<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class homeuser extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('libreta_model');
    }

    
    public function index() {

        $data = array();
        $data['messi'] = "";
        $data['upload']=  $this->uploadLastBooks($this->session->userdata('username'));
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/homeuser/homeuser';
        $data['username'] = $this->session->userdata('username');
        $data['title'] = 'Home Page User';
        $this->load->view('/includes/templates', $data);
    }

    public function index2() {
        $data = array();
        $data['upload']=  $this->uploadLastBooks($this->session->userdata('username'));
        $data['messi'] = "<a id='success-title'></a>
        <script>
            new popUp('LOGIN EXITOSO', 
            {title: 'WELCOME', titleClass: 'success', 
            autoclose: '1000'});
        </script>";
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/homeuser/homeuser';
        $data['username'] = $this->session->userdata('username');
        //$data['username'] = $username;
        // $data['user'] = $success;
        //echo $data['main_content'];
        $data['title'] = 'Home Page User';
        $this->load->view('/includes/templates', $data);
    }

    public function uploadLastBooks($username) {
        $return = '';

        $base_url = base_url() . 'images/home.png';
        $return = '';
        for ($i = 0; $i < $this->libreta_model->tamListLibreta($username); $i++) {


            $libreta = new Libreta_Model();
            $libreta = $libreta->libretaAtIndex($i, $username);

            $nombre = $libreta->getNombre();
            //$libreta->setNombre('abel');
            $id = $libreta->getId_libreta();
            $fecha = $libreta->getFecha();
            $descripcion = $libreta->getDescripcion();

            if ($i < 3) {

                $return = $return . " <li>
                            <a title='An image'><img src=$base_url /></a>
                            <div class='excerpt'>
                   
             
                                <a class='header'>$nombre</a>
                                $descripcion
                            </div>
                           
                        </li>";
            }
        }
        return $return;
    }

}
