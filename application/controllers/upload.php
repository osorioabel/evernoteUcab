<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
class Upload extends CI_Controller {

    /**
     *  Funcion Constructor del controlador, se realizan cargas de 
     * algunos modelos y helpers usuados en el funcionamiento de 
     * el controlador 
     *  
     * @category	Controller
     */
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->model('usuario_model');
        $this->load->model('nota_model');
        $this->load->model('adjunto_model');
    }

    
    function index() {
        $this->load->view('upload_form', array('error' => ' '));
    }
    /**
     * Funcion do_upload() Esta funcion se encarga realiar la carga de los adjuntos
     * al servidor para ser luego subidos a dropbox 
     * @category	Controller
     * 
     */
    function do_upload() {
        $config['upload_path'] = './subidos/';
        $config['allowed_types'] = 'gif|jpg|png|zip|avi';
       
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            echo '<div id="status">error</div>';
            echo '<div id="message">' . $this->upload->display_errors() . '</div>';
        } else {
            $data = array('upload_data' => $this->upload->data());
            echo '<div id="status">success</div>';
            //then output your message (optional)
            echo '<div id="message">' . $data['upload_data']['file_name'] . ' Successfully uploaded.</div>';
            //pass the data to js
            echo '<div id="upload_data">' . json_encode($data) . '</div>';
            $this->upload_file($data['upload_data']['file_name']);
        }
    }
    
     /**
     * Funcion request_dropbox() Esta funcion se encarga realizar peticion al 
     * api de DROPBOX para autentificar al usuario
     * @category	Controller
     * 
     */
    public function request_dropbox() {
        $params['key'] = 'e9us87r5ehin30k';
        $params['secret'] = 'vvzs5zc3kwt305c';
        $this->load->library('dropbox', $params);
        $data = $this->dropbox->get_request_token(site_url("/example/access_dropbox"));
        $this->session->set_userdata('token_secret', $data['token_secret']);
        redirect($data['redirect']);
        
    }

     /**
     * Funcion access_dropbox() Esta funcion se encarga realizar peticion al 
     * api de DROPBOX para autentificar al usuario y deja al usuario introducir su clave 
     * y usuario de dropbox
     * @category	Controller
     * 
     */
    public function access_dropbox() {
        $params['key'] = 'e9us87r5ehin30k';
        $params['secret'] = 'vvzs5zc3kwt305c';
        $user=  $this->session->userdata('username');
        $this->load->library('dropbox', $params);
        $oauth = $this->dropbox->get_access_token($this->session->userdata('token_secret'));
        $this->session->set_userdata('oauth_token', $oauth['oauth_token']);
        $this->session->set_userdata('oauth_token_secret', $oauth['oauth_token_secret']);
        // se actualiza el token del uauario en la BD
        $booleano= $this->usuario_model->modificartoken($user,$oauth['oauth_token'],$oauth['oauth_token_secret']);
        redirect('/homeuser/index');
    }

     /**
     * Funcion test_dropbox()  Esta funcion se encarga realizar peticion al 
     * api de DROPBOX para verificar que si se autentifico usuario 
     * @category	Controller
     * 
     */
    public function test_dropbox() {
        $params['key'] = 'e9us87r5ehin30k';
        $params['secret'] = 'vvzs5zc3kwt305c';
        $params['access'] = array('oauth_token' => urlencode($this->session->userdata('oauth_token')),
         'oauth_token_secret' => urlencode($this->session->userdata('oauth_token_secret')));

        $this->load->library('dropbox', $params);

        $return = $this->dropbox->account();

       
    }

     /**
     * Funcion upload_file($filename)  Esta funcion se encarga realizar peticion al 
     * api de DROPBOX para subir archivo
     * @category	Controller
      * @param string $filename nombre del archivo a subir
     * 
     */
    public function upload_file($filename) {
        $folder = 'evernoteUcab';
        $subidos='subidos/';
        $params['key'] = 'e9us87r5ehin30k';
        $params['secret'] = 'vvzs5zc3kwt305c';
        $params['access'] = array('oauth_token' => urlencode($this->session->userdata('oauth_token')),
            'oauth_token_secret' => urlencode($this->session->userdata('oauth_token_secret')));
        $this->load->library('dropbox', $params);
        $arrayfalso=array();
        $this->adjunto_model->registeradjunto($filename, $filename);
       
        $return = $this->dropbox->add($folder,$subidos.$filename,$arrayfalso,'dropbox');
      
        print_r($return);
        
    }
    
     /**
     * Funcion create_folder()  Esta funcion se encarga realizar peticion al 
     * api de DROPBOX para crear carpeta en dropbox 
     * @category	Controller
      * @param string $filename nombre del archivo a subir
     * 
     */
    public function create_folder() {

        $params['key'] = 'e9us87r5ehin30k';
        $params['secret'] = 'vvzs5zc3kwt305c';
        $params['access'] = array('oauth_token' => urlencode($this->session->userdata('oauth_token')),
            'oauth_token_secret' => urlencode($this->session->userdata('oauth_token_secret')));
        $this->load->library('dropbox', $params);
        $return = $this->dropbox->create_folder('/prueba/prueba','dropbox');
        print_r($return);
    }

}

?>