<?php

class Usuario_Model extends CI_Model {
    
    private $username = '';
    private $password = '';
    private $email = '';
    private $userdropbox = '';
    private $passdropbox = '';
    private $name ;
    private $apellido;
    
    

    

    function __construct() {
        parent::__construct();
        $this->username='';
    }

    function login($username, $password) {

        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('usuario');
        if ($query->num_rows > 0) {
            return TRUE;
        }

        return FALSE;
    }

    function register($username, $email, $password, $dropboxemail, $dropboxpassword) {

        $data = array('username' => $username,
            'email' => $email,
            'password' => $password,
            'cuentadropbox' => $dropboxemail,
            'passdropbox' => $dropboxpassword,
        );
        $insert = $this->db->insert('usuario', $data);
        $insert['error']= $this->db->_error_message();
        if($insert['error']!= '')
         return false;
        return true;
    }

  

}

