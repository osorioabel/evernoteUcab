<?php

class Usuario_Model extends CI_Model implements Usuario_DAO {
 
    

    function __construct() {
        parent::__construct();
      
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

    function register($name,$lastname,$username, $email, $password) {

        $data = array(
            'nombre' =>$name,
            'apellido'=> $lastname,
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        
       $insert = $this->db->insert('usuario', $data);
       $insert2 = array();
       $insert2['error']= $this->db->_error_message();
       if($insert['error']!= '')
        return false;
       return true;
      
    }

     function modificar($username,$nombre, $apellido,$email){
          $data = array('nombre' => $nombre,
            'apellido' => $apellido,  
            'email' => $email,
        );
         $this->db->where('username',$username);
         $this->db->update('usuario',$data);
       
        if($this->db->_error_message())
         return false;
        
        return true;
     }
     
     function cambiarClave($username,$password){
          $data = array('password' => $password,
          );
         $this->db->where('username',$username);
         $this->db->update('usuario',$data);
       
        if($this->db->_error_message())
         return false;
        
        return true;
     }
     
     function configuarDropbox($username,$cuentadropbox,$passdropbox){
          $data = array('cuentadropbox' => $cuentadropbox,
                        'passdropbox' => $passdropbox,
          );
         $this->db->where('username',$username);
         $this->db->update('usuario',$data);
       
        if($this->db->_error_message())
         return false;
        
        return true;
     }
     
     public function updatetoken(Usuario_OD $usuario){
      
          
          $data = array('auth_token' => $usuario->getOauth_token(),
                        'auth_token_secret' => $usuario->getOauth_token_secret(),
          );
         $this->db->where('username',$username);
         $this->db->update('usuario',$data);
       
        if($this->db->_error_message())
         return false;
        
        return true;
     }
     
     

}

