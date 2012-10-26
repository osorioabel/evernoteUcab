<?php

class Upload extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->model('usuario_model');
    }

    function index() {
        $this->load->view('upload_form', array('error' => ' '));
    }

    function do_upload() {
        $config['upload_path'] = './subidos/';
        $config['allowed_types'] = 'gif|jpg|png|zip|avi';
        /* $config['max_size']	= '1000';
          $config['max_width']  = '1024';
          $config['max_height']  = '768'; */

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
        $user=  $this->session->userdata('username');
        $this->load->library('dropbox', $params);
        $oauth = $this->dropbox->get_access_token($this->session->userdata('token_secret'));
        $this->session->set_userdata('oauth_token', $oauth['oauth_token']);
        $this->session->set_userdata('oauth_token_secret', $oauth['oauth_token_secret']);
        $booleano= $this->usuario_model->modificartoken($user,$oauth['oauth_token'],$oauth['oauth_token_secret']);
        redirect('/homeuser/index');
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

    public function upload_file($filename) {
        $folder = 'evernoteUcab';
        $subidos='subidos/';
        
        $params['key'] = 'e9us87r5ehin30k';
        $params['secret'] = 'vvzs5zc3kwt305c';
        $params['access'] = array('oauth_token' => urlencode($this->session->userdata('oauth_token')),
            'oauth_token_secret' => urlencode($this->session->userdata('oauth_token_secret')));
        $this->load->library('dropbox', $params);
        $arrayfalso=array();
        $this->
        $return = $this->dropbox->add($folder,$subidos.$filename,$arrayfalso,'dropbox');
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

?>