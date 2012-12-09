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
class homeuser extends CI_Controller {

    /**
     *  Funcion Constructor del controlador, se realizan cargas de 
     * algunos modelos y helpers usuados en el funcionamiento de 
     * el controlador 
     *  
     * @category	Controller
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('libreta_model');
    }

    /**
     *  Funcion index() se realizan las 
     * llamadas basicas para la carga de una de las vistas 
     * que se estan linkeadas al controlador 
     *  
     * @category	Controller
     */
    public function index() {

        $data = array();
        $data['messi'] = "";
        $data['upload'] = $this->uploadLastBooks($this->session->userdata('username'));
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/homeuser/homeuser';
        $data['username'] = $this->session->userdata('username');
        $data['title'] = 'Home Page User';
        $this->load->view('/includes/templates', $data);
    }
    
     /**
     *  Funcion indexAU() se realizan las 
     * llamadas al about us de la pagina 
     * que se estan linkeadas al controlador 
     *  
     * @category	Controller
     */
    
    public function indexAU() {

        $data = array();
        $data['messi'] = "";
        $data['upload'] = $this->uploadLastBooks($this->session->userdata('username'));
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/homeuser/aboutUs';
        $data['username'] = $this->session->userdata('username');
        $data['title'] = 'About Us';
        $this->load->view('/includes/templates', $data);
    }
   
    /**
     *  Funcion index2() se realizan las 
     * llamadas basicas para la carga de una de las vistas 
     * que se estan linkeadas al controlador 
     *  
     * @category	Controller
     */
    public function index2() {
        $data = array();
        $data['upload'] = $this->uploadLastBooks($this->session->userdata('username'));
        $data['messi'] = "<a id='success-title'></a>
        <script>
            new popUp('SUCCESSFULL', 
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
    
    

    /**
     * Funcion uploadLastBooks($username) Esta funcion se encarga de 
     * preguntar a la capa de modelo, cuales han sido las ultimas 3 libretas 
     * creadas por el usuario. Para luego armar HTML que sera pasado a la 
     * vista al momento del login exitoso del usuario.
     *  
     * @category	Controller
     * @param 	        string usuario que se encuentra activo
     * @return          string codigo HTML contiene las tres ultimas libretas que creo el usuario 
     */
    public function uploadLastBooks($username) {
        $return = '';

        $base_url = base_url() . 'images/home.png';
        $return = '';
        for ($i = 0; $i < $this->libreta_model->tamListLibreta($username); $i++) {

            $libreta = new Libreta_Model();
            $libreta = $libreta->libretaAtIndex($i, $username);
            $nombre = $libreta->getNombre();
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
