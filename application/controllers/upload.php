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
class Upload extends CI_Controller {

    private $key = 'e9us87r5ehin30k';
    private $secret = 'vvzs5zc3kwt305c';

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
        $this->load->model('dropbox_model');
        $this->load->model('nota_adjunto_model');
        
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
        $config['allowed_types'] = 'gif|jpg|png|zip|avi|xml';

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
        $params['key'] = $this->key;
        $params['secret'] = $this->secret;
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
        $params['key'] = $this->key;
        $params['secret'] = $this->secret;
        $user = $this->session->userdata('username');
        $this->load->library('dropbox', $params);
        $oauth = $this->dropbox->get_access_token($this->session->userdata('token_secret'));
        $this->session->set_userdata('oauth_token', $oauth['oauth_token']);
        $this->session->set_userdata('oauth_token_secret', $oauth['oauth_token_secret']);
        // se actualiza el token del uauario en la BD
        $booleano = $this->usuario_model->modificartoken($user, $oauth['oauth_token'], $oauth['oauth_token_secret']);
        redirect('/homeuser/index');
    }

    /**
     * Funcion test_dropbox()  Esta funcion se encarga realizar peticion al 
     * api de DROPBOX para verificar que si se autentifico usuario 
     * @category	Controller
     * 
     */
    public function test_dropbox($username) {
        $params['key'] = $this->key;
        $params['secret'] = $this->secret;
        $data = array();
        $data = $this->usuario_model->getUserToken($username);
        $params['access'] = $data;
        $this->load->library('dropbox', $params);

        $retorno = $this->dropbox->account();
        print_r($retorno);
        $return = $retorno;
    }

    public function test_dropbox_model($username) {

        $retorno = $this->dropbox_model->test_dropbox($username);
        if ($retorno != false) {
            echo "si";
        } else {
            echo 'vacio';
        }
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
        $subidos = 'subidos/';
        $params['key'] = $this->key;
        $params['secret'] = $this->secret;
        $params['access'] = array('oauth_token' => urlencode($this->session->userdata('oauth_token')),
            'oauth_token_secret' => urlencode($this->session->userdata('oauth_token_secret')));
       $this->load->library('dropbox', $params);
       $arrayfalso = array();
       $return = $this->dropbox->add($folder, $subidos . $filename, $arrayfalso, 'dropbox');
       $linkarchivo=$this->create_link($filename);
       $boolean = $this->adjunto_model->registeradjunto($linkarchivo, $filename);
       if ($boolean == true){
       $notaid=  $this->nota_model->getMaxID();
       $adjuntoid= $this->adjunto_model->getMaxID();
       $this->nota_adjunto_model->registeradjunto_nota($notaid, $adjuntoid);
       }
    }

    /**
     * Funcion create_folder()  Esta funcion se encarga realizar peticion al 
     * api de DROPBOX para crear carpeta en dropbox 
     * @category	Controller
     * @param string $filename nombre del archivo a subir
     * 
     */
    public function create_folder() {

        $params['key'] = $this->key;
        $params['secret'] = $this->secret;
        $params['access'] = array('oauth_token' => urlencode($this->session->userdata('oauth_token')),
            'oauth_token_secret' => urlencode($this->session->userdata('oauth_token_secret')));
        $this->load->library('dropbox', $params);
        $return = $this->dropbox->create_folder('/prueba/prueba', 'dropbox');
        print_r($return);
    }
    
    public function create_link($nombrearchivo) {

        $params['key'] = $this->key;
        $params['secret'] = $this->secret;
        $params['access'] = array('oauth_token' => urlencode($this->session->userdata('oauth_token')),
        'oauth_token_secret' => urlencode($this->session->userdata('oauth_token_secret')));
        $this->load->library('dropbox', $params);
        $return = $this->dropbox->media('/evernoteUcab/'.$nombrearchivo, 'dropbox');
        return $return->url;
        
        }
    
    

}

?>