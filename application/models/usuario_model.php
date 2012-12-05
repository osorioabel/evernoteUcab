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

class Usuario_Model extends CI_Model {

    private $username = '';
    private $password = '';
    private $email = '';
    private $oauth_token = '';
    private $oauth_token_secret = '';
    private $name = '';
    private $apellido = '';

    
    function __construct() {
        parent::__construct();
        $this->oauth_token='';
        $this->oauth_token_secret='';
        
    }
    
  
    /**
    * 
    *
    * Esta Funcion  modificartoken($username, $nombre, $apellido)
    *  se encarga de actualizar en la base de datos 
    * el token que ha aignado el dropbox para su acceso  
    *@category Modelo
    * @param	string  Indica el Usuario 
    * @param	string	nombre del usuario
    * @param	string	apellido del usuario
    * @return	boolean dice si actualizo o no 
    */
   public function modificartoken($username, $nombre, $apellido) {
        $data = array('oauth_token' => $nombre,
            'oauth_token_secret' => $apellido,  );
        $this->db->where('username', $username);
        $this->db->update('usuario', $data);

        if ($this->db->_error_message())
            return false;

        return true;
    }

    /**
    * 
    *
    * Esta Funcion login($username, $password) se encarga verificar los datos del
    * usuario y autentificar su acceso a la app
    *@category Modelo
    * @param	string  Indica el Usuario 
    * @param	string	password del usuario
    * @return	boolean dice si actualizo o no 
    */
    public function login($username, $password) {

        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('usuario');
        if ($query->num_rows>0) {
            return TRUE;
        }
        
        return FALSE;
    }

    /**
    * 
    *
    * Esta Funcion register($name, $lastname, $username, $email, $password) 
    * se encarga de registrar en la base de datos 
    * a un usuario
    *@category Modelo
    * @param	string	nombre del usuario
    * @param	string	apellido del usuario
    * @param	string	username del usuario
    * @param	string	email del usuario
    * @param	string	password del usuario
    * @return	boolean dice si actualizo o no 
    */
    public function register($name, $lastname, $username, $email, $password) {

        $data = array(
            'nombre' => $name,
            'apellido' => $lastname,
            'username' => $username,
            'email' => $email,
            'password' => $password
        );

        $this->db->insert('usuario', $data);
        if ($this->db->_error_message()){
             log_message("error","User Already Exists");
            return false;
        }
        return true;
    }

    /**
    * 
    *
    * Esta Funcion modificar($username, $nombre, $apellido, $email) 
    * se encarga de actualizar en la base de datos 
    * datos del usuario  
    *@category Modelo
    * @param	string  Indica el Usuario 
    * @param	string	nombre del usuario
    * @param	string	apellido del usuario
    * @param	string	email del usuario
    * @return	boolean dice si actualizo o no 
    */
    public function modificar($username, $nombre, $apellido, $email) {
        $data = array('nombre' => $nombre,
            'apellido' => $apellido,
            'email' => $email,
        );
        $this->db->where('username', $username);
        $this->db->update('usuario', $data);

        if ($this->db->_error_message())
            return false;

        return true;
    }
    
    /**
    * 
    *
    * Esta Funcion getUser($username) se encarga de traer de  base de datos 
    *  datos del usuario
    *@category Modelo
    * @param	string  Indica el username a buscar 
    * @return	object dice si actualizo o no 
    */
       public function deleteuser($username) {
        $user = new Usuario_Model();
        $query = $this->db->query("delete from usuario where username='$username'");
          if ($this->db->_error_message())
            return false;

        return true;
    }

    /**
    * 
    *
    * Esta Funcion cambiarClave($username, $password) 
    * se encarga de actualizar en la base de datos 
    * el password que ha sido cambiado
    *@category Modelo
    * @param	string  Indica el Usuario 
    * @param	string	indica la clave 
     * @return	boolean dice si actualizo o no 
    */
    public function cambiarClave($username, $password) {
        $data = array('password' => $password,
        );
        $this->db->where('username', $username);
        $this->db->update('usuario', $data);

        if ($this->db->_error_message())
            return false;

        return true;
    }
    
    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getOauth_token() {
        return $this->oauth_token;
    }

    public function setOauth_token($oauth_token) {
        $this->oauth_token = $oauth_token;
    }

    public function getOauth_token_secret() {
        return $this->oauth_token_secret;
    }

    public function setOauth_token_secret($oauth_token_secret) {
        $this->oauth_token_secret = $oauth_token_secret;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }


    
}

   


