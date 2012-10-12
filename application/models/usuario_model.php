<?php

class Usuario_Model extends CI_Model {
    
    
      function __construct()
    {
        parent::__construct();
    }
    
    function login($username,$password){
        
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('usuario');
        if($query->num_rows>0){
            
            return TRUE;
        }
       
        return FALSE;
    }
    
    function register($username,$email,$password,$dropboxemail,$dropboxpassword){
        
      $data= array('username' => $username,
             'email' => $email,
             'password' => $password,
             'cuentadropbox' => $dropboxemail,
             'passdropbox' => $dropboxpassword,
           );
       
           return $this->db->insert('usuario',$data);
    
    }
}


