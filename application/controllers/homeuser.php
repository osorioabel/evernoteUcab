<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class homeuser extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        $data = array();
        $data['messi'] = "";
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/homeuser/homeuser';
        $data['username'] = $this->session->userdata('username');
        $data['title'] = 'Home Page User';
        $this->load->view('/includes/templates', $data);
    }

    public function index2() {
        $data = array();
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

}
