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
class Usuario_Model extends CI_Model {

    private $username = '';
    private $password = '';
    private $email = '';
    private $oauth_token = '';
    private $oauth_token_secret = '';
    private $name = '';
    private $apellido = '';
    private $id_user = '';

    public function getId_user() {
        return $this->id_user;
    }

    public function setId_user($id_user) {
        $this->id_user = $id_user;
    }

    function __construct() {
        parent::__construct();
        $this->oauth_token = '';
        $this->oauth_token_secret = '';
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->model('libreta_model');
        $this->load->model('nota_model');
        $this->load->model('adjunto_model');
        $this->load->model("nota_adjunto_model");
    }

    /**
     * 
     *
     * Esta Funcion  modificartoken($username, $nombre, $apellido)
     *  se encarga de actualizar en la base de datos 
     * el token que ha aignado el dropbox para su acceso  
     * @category Modelo
     * @param	string  Indica el Usuario 
     * @param	string	nombre del usuario
     * @param	string	apellido del usuario
     * @return	boolean dice si actualizo o no 
     */
    public function modificartoken($username, $nombre, $apellido) {
        $data = array('oauth_token' => $nombre,
            'oauth_token_secret' => $apellido,);
        $this->db->where('username', $username);
        $this->db->update('usuario', $data);

        if ($this->db->_error_message()) {

            log_message("error", "Error chaging a secret token ");
            return false;
        }
        log_message("error", "Succesfull chaging a secret token ");
        return true;
    }

    /**
     * 
     *
     * Esta Funcion login($username, $password) se encarga verificar los datos del
     * usuario y autentificar su acceso a la app
     * @category Modelo
     * @param	string  Indica el Usuario 
     * @param	string	password del usuario
     * @return	boolean dice si actualizo o no 
     */
    public function login($username, $password) {

        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('usuario');
        if ($query->num_rows > 0) {
            log_message("error", "Succesfull Login ");
            return TRUE;
        }

        log_message("error", "Error in  Login ");
        return FALSE;
    }

    /**
     * 
     *
     * Esta Funcion register($name, $lastname, $username, $email, $password) 
     * se encarga de registrar en la base de datos 
     * a un usuario
     * @category Modelo
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
        if ($this->db->_error_message()) {
            log_message("error", "User Already Exists");
            return false;
        }
        log_message("error", "Succesfull Register ");
        return true;
    }

    /**
     * 
     *
     * Esta Funcion modificar($username, $nombre, $apellido, $email) 
     * se encarga de actualizar en la base de datos 
     * datos del usuario  
     * @category Modelo
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

        if ($this->db->_error_message()) {
            log_message("error", "Error modification a user  ");
            return false;
        }
        log_message("error", "Succesfull modification a user  ");
        return true;
    }

    /**
     * 
     *
     * Esta Funcion getUser($username) se encarga de traer de  base de datos 
     *  datos del usuario
     * @category Modelo
     * @param	string  Indica el username a buscar 
     * @return	object dice si actualizo o no 
     */
    public function getUser($username) {
        $this->db->where('username', $username);
        $query = $this->db->get('usuario');
        $row2 = $query->row();

        $this->setName($row2->nombre);
        $this->setApellido($row2->apellido);
        $this->setEmail($row2->email);
        $this->setId_user($row2->id_usuario);

        return $row2;
    }

    public function getUserInfoxml($username) {


        $this->load->dbutil();
        // libretas
        $sql2 = "select l.id_libreta,l.nombre,l.descripcion,l.fecha from libreta l, usuario u where u.username = '$username' and u.id_usuario = l.fk_usuario";
        $query2 = $this->db->query($sql2);
        $config2 = array(
            'root' => 'infousuario',
            'element' => 'libreta',
            'newline' => "\n",
            'tab' => "\t"
        );
        $xml2 = $this->dbutil->xml_from_result($query2, $config2);
        $xml3 = $xml2;


        // notas 
        $sql3 = "select n.id_nota,n.titulo,n.texto,n.fecha_creacion,n.id_libreta from nota n,libreta l, usuario u where u.id_usuario = l.fk_usuario and n.id_libreta = l.id_libreta and u.username = '$username' ";
        $query3 = $this->db->query($sql3);
        $config3 = array(
            //  'root' => 'notas',
            'element' => 'nota',
            'newline' => "\n",
            'tab' => "\t"
        );
        $xml4 = $this->dbutil->xml_from_result($query3, $config3);


        $xml5 = $xml3 . $xml4;

        // adjuntos 
        $sql4 = "select a.id_adjunto,a.link,a.nombre from nota n,libreta l, usuario u , adjunto a , nota_adjunto na where u.id_usuario = l.fk_usuario and n.id_libreta = l.id_libreta and na.fk_nota = n.id_nota and na.fk_adjunto = a.id_adjunto 
and u.username = '$username'";
        $query4 = $this->db->query($sql4);
        $config4 = array(
            //    'root' => 'adjuntos',
            'element' => 'adjunto',
            'newline' => "\n",
            'tab' => "\t"
        );
        $xml6 = $this->dbutil->xml_from_result($query4, $config4);


        $xml7 = $xml5 . $xml6;


        $this->load->helper('download');
        force_download($username . '.xml', $xml7);

        return true;
    }

    public function getUserInfoxml2($username) {


        // Load XML writer library
        $this->load->library('xml_writer');

        // Initiate class
        $xml = new Xml_writer();
        $xml->setRootName('inforuser');
        $xml->initiate();

        // Start branch 1
         $xml->startBranch('libretas');
        $sql2 = "select l.id_libreta,l.nombre,l.descripcion,l.fecha, l.fk_usuario from libreta l, usuario u where u.username = '$username' and u.id_usuario = l.fk_usuario";
        $query2 = $this->db->query($sql2);
        $records = $query2->result();
        
        foreach ($records as $c):
            // Set branch 1-1 and its nodes
            //  $xml->startBranch('libreta'); // start branch 1-1
            $xml->startBranch('libreta');
            $xml->addNode('id_libreta', $c->id_libreta);
            $xml->addNode('fk_usuario', $c->fk_usuario);
            $xml->addNode('nombre', $c->nombre);
            $xml->addNode('fecha', $c->fecha);
            $xml->addNode('descripcion', $c->descripcion);

            // End branch 1
            $xml->endBranch();
        endforeach;
       
        $xml->endBranch();
        

        // notas
        $sql3 = "select n.id_nota,n.titulo,n.texto,n.fecha_creacion,n.id_libreta from nota n,libreta l, usuario u where u.id_usuario = l.fk_usuario and n.id_libreta = l.id_libreta and u.username = '$username' ";
        $query3 = $this->db->query($sql3);
        $records2 = $query3->result();
        $xml->startBranch('notas');
        foreach ($records2 as $c2):

            $xml->startBranch('nota');
            $xml->addNode('id_nota', $c2->id_nota);
            $xml->addNode('titulo', $c2->titulo);
            $xml->addNode('texto', $c2->texto);
            $xml->addNode('fecha_creacion', $c2->fecha_creacion);
            $xml->addNode('id_libreta', $c2->id_libreta);

            // End branch 1
            $xml->endBranch();
        endforeach;
   





        $this->load->helper('download');
        force_download($username . '.xml', $xml->getXml());

        return $xml->getXml();
    }

    public function SetUserInfoFromxml($username) {

        $doc = new DOMDocument();
        $doc->load("subidos/usuarioy.xml"); //xml file loading here

        $employees = $doc->getElementsByTagName("libreta");
        $final2 = "";
        foreach ($employees as $employee) :
            for ($i = 0; $i < count($employee); $i++) {
                $names = $employee->getElementsByTagName("fk_usuario");
                $userID = $names->item($i)->nodeValue;

                $names2 = $employee->getElementsByTagName("id_libreta");
                $id_libreta = $names2->item($i)->nodeValue;


                $ages = $employee->getElementsByTagName("nombre");
                $title = $ages->item($i)->nodeValue;

                $salaries = $employee->getElementsByTagName("descripcion");
                $descrip = $salaries->item($i)->nodeValue;
                $this->libreta_model->registerBookwithID($userID, $title, $descrip, $id_libreta);
            }
           
        endforeach;
        
        $employees2= $doc->getElementsByTagName("nota");
        $final2 = "";
        foreach ($employees2 as $employee2) :
            for ($i = 0; $i < count($employee2); $i++) {
                
                $names = $employee2->getElementsByTagName("id_nota");
                $userID = $names->item($i)->nodeValue;

                $names2 = $employee2->getElementsByTagName("titulo");
                $id_libreta = $names2->item($i)->nodeValue;


                $ages = $employee2->getElementsByTagName("texto");
                $title = $ages->item($i)->nodeValue;

                $salaries = $employee2->getElementsByTagName("fecha_creacion");
                $descrip = $salaries->item($i)->nodeValue;
                
                $salaries2 = $employee2->getElementsByTagName("id_libreta");
                $descrip2 = $salaries->item($i)->nodeValue;
                
                
                $this->libreta_model->registerBookwithID($userID, $title, $descrip, $id_libreta);
            }
            endforeach;
        
    }

    /**
     * 
     *
     * Esta Funcion getUserToken($username) se encarga de traer de  base de datos 
     *  datos del usuario
     * @category Modelo
     * @param	string  Indica el username a buscar 
     * @return	object dice si actualizo o no 
     */
    public function getUserToken($username) {
        $this->db->where('username', $username);
        $query = $this->db->get('usuario');
        $row2 = $query->row();
        if ($row2 != null) {
            $token = $row2->oauth_token;
            $secret = $row2->oauth_token_secret;

            $data = array('oauth_token' => $token,
                'oauth_token_secret' => $secret);

            return $data;
        }
        return false;
    }

    public function getIDuser($username) {

        $this->db->where('username', $username);
        $query = $this->db->get('usuario');
        $row2 = $query->row();
        if ($row2 != null) {
            $id = $row2->id_usuario;
            return $id;
        }
        return false;
    }

    public function deleteuser($username) {
        $user = new Usuario_Model();
        $query = $this->db->query("delete from usuario where username='$username'");
        if ($this->db->_error_message()) {
            log_message("error", "Error deleting  a user  ");
            return false;
        }
        log_message("error", "Succesfull deleting a user  ");
        return true;
    }

    /**
     * 
     *
     * Esta Funcion cambiarClave($username, $password) 
     * se encarga de actualizar en la base de datos 
     * el password que ha sido cambiado
     * @category Modelo
     * @param	string  Indica el Usuario 
     * @param	string	indica la clave 
     * @return	boolean dice si actualizo o no 
     */
    public function cambiarClave($username, $password) {
        $data = array('password' => $password,
        );
        $this->db->where('username', $username);
        $this->db->update('usuario', $data);

        if ($this->db->_error_message()) {
            log_message("error", "Error deleting a user  ");
            return false;
        }
        log_message("error", "Succesfull deleting a user  ");
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

