<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Example extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('usuario_model');
        include_once(APPPATH . 'controllers/usuario.php');
        
        
    }

    // Call this method first by visiting http://SITE_URL/example/request_dropbox
    public function request_dropbox() {
        $params['key'] = 'e9us87r5ehin30k';
        $params['secret'] = 'vvzs5zc3kwt305c';
        $this->load->library('dropbox', $params);
        $data = $this->dropbox->get_request_token(site_url("/example/access_dropbox"));
        $this->session->set_userdata('token_secret', $data['token_secret']);
        redirect($data['redirect']);
        
    }

    //This method should not be called directly, it will be called after 
    //the user approves your application and dropbox redirects to it
    public function access_dropbox() {
        $params['key'] = 'e9us87r5ehin30k';
        $params['secret'] = 'vvzs5zc3kwt305c';

        $this->load->library('dropbox', $params);
        $oauth = $this->dropbox->get_access_token($this->session->userdata('token_secret'));
        $this->session->set_userdata('oauth_token', $oauth['oauth_token']);
        $this->session->set_userdata('oauth_token_secret', $oauth['oauth_token_secret']);
        $booleano= $this->usuario_model->modificartoken('hjmatheus',$oauth['oauth_token'],$oauth['oauth_token_secret']);
        redirect('/example/upload_file');
    }

    //Once your application is approved you can proceed to load the library
    //with the access token data stored in the session. If you see your account
    //information printed out then you have successfully authenticated with
    //dropbox and can use the library to interact with your account.
    public function test_dropbox() {
        $params['key'] = 'e9us87r5ehin30k';
        $params['secret'] = 'vvzs5zc3kwt305c';
        $params['access'] = array('oauth_token' => urlencode($this->session->userdata('oauth_token')),
            'oauth_token_secret' => urlencode($this->session->userdata('oauth_token_secret')));

        $this->load->library('dropbox', $params);

        $return = $this->dropbox->account();

        print_r($return);
    }

    public function upload_file() {

        $params['key'] = 'e9us87r5ehin30k';
        $params['secret'] = 'vvzs5zc3kwt305c';
        $params['access'] = array('oauth_token' => urlencode($this->session->userdata('oauth_token')),
            'oauth_token_secret' => urlencode($this->session->userdata('oauth_token_secret')));
        $this->load->library('dropbox', $params);
        $arrayfalso=array();
        $return = $this->dropbox->add('prueba', 'dropbox/02.jpg',$arrayfalso,'dropbox');
        print_r($return);
    }
    
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

/* End of file example.php */
/* Location: ./application/controllers/welcome.php */