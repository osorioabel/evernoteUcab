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
        $this->load->model('etiqueta_model');
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
        $sql4 = "select a.id_adjunto,a.link,a.nombre from nota n,libreta l, usuario u , adjunto a , nota_adjunto na where u.id_usuario = l.fk_usuario and n.id_libreta = l.id_libreta and na.fk_nota = n.id_nota and na.fk_adjunto = a.id_adjunto and u.username = '$username'";
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
    
    public function getUserInfoxml3($username) {

        if($this->getIDuser2($username)){
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
        
         $xml->endBranch();
        // adjuntos
        
        $sql4 = "select a.id_adjunto,a.link,a.nombre from nota n,libreta l, usuario u , adjunto a , nota_adjunto na where u.username = '$username' and u.id_usuario = l.fk_usuario and n.id_libreta = l.id_libreta and na.fk_nota = n.id_nota and na.fk_adjunto = a.id_adjunto";
        $query4 = $this->db->query($sql4);
        $records3 = $query4->result();
        $xml->startBranch('adjuntos');
        foreach ($records3 as $c3):

            $xml->startBranch('adjunto');
            $xml->addNode('id_adjunto', $c3->id_adjunto);
            $xml->addNode('link', $c3->link);
            $xml->addNode('nombre', $c3->nombre);
            // End branch 1
            $xml->endBranch();
        endforeach;
        
          $xml->endBranch();
        //etiquetas
          $sql5 = "select e.id_etiqueta,e.texto from nota n,libreta l, usuario u , etiqueta e , nota_etiqueta ne where u.username = '$username' and u.id_usuario = l.fk_usuario and n.id_libreta = l.id_libreta and ne.fk_nota = n.id_nota and ne.fk_etiqueta = e.id_etiqueta";
        $query5 = $this->db->query($sql5);
        $records5 = $query5->result();
        $xml->startBranch('etiquetas');
        foreach ($records5 as $c5):

            $xml->startBranch('etiqueta');
            $xml->addNode('id_etiqueta', $c5->id_etiqueta);
            $xml->addNode('texto', $c5->texto);
            // End branch 1
            $xml->endBranch();
        endforeach;
        
          $xml->endBranch();
        
       //notas-etiqueta
        
        $sql6 = "select ne.fk_nota,ne.fk_etiqueta from nota n,libreta l, usuario u , etiqueta e , nota_etiqueta ne where u.username = '$username' and u.id_usuario = l.fk_usuario and n.id_libreta = l.id_libreta and ne.fk_nota = n.id_nota and ne.fk_etiqueta = e.id_etiqueta";
        $query6 = $this->db->query($sql6);
        $records6 = $query6->result();
        $xml->startBranch('notaEtiquetas');
        foreach ($records6 as $c6):

            $xml->startBranch('notaEtiqueta');
            $xml->addNode('fk_nota', $c6->fk_nota);
            $xml->addNode('fk_etiqueta', $c6->fk_etiqueta);
            // End branch 1
            $xml->endBranch();
        endforeach;
        
          $xml->endBranch();
// nota-adjunto       
           $sql6 = "select na.fk_nota,na.fk_adjunto from nota n,libreta l, usuario u , adjunto a, nota_adjunto na where u.username = '$username' and u.id_usuario = l.fk_usuario and n.id_libreta = l.id_libreta and na.fk_nota = n.id_nota and na.fk_adjunto = a.id_adjunto";
        $query6 = $this->db->query($sql6);
        $records6 = $query6->result();
        $xml->startBranch('notaAdjuntos');
        foreach ($records6 as $c6):

            $xml->startBranch('notaAdjunto');
            $xml->addNode('fk_nota', $c6->fk_nota);
            $xml->addNode('fk_adjunto', $c6->fk_adjunto);
            // End branch 1
            $xml->endBranch();
        endforeach;
        
        
          return $xml->getXml();
        }



       // $this->load->helper('download');
       // force_download($username . '.xml', $xml->getXml());

        return false;
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
        
         $xml->endBranch();
        // adjuntos
        
        $sql4 = "select a.id_adjunto,a.link,a.nombre from nota n,libreta l, usuario u , adjunto a , nota_adjunto na where u.username = '$username' and u.id_usuario = l.fk_usuario and n.id_libreta = l.id_libreta and na.fk_nota = n.id_nota and na.fk_adjunto = a.id_adjunto";
        $query4 = $this->db->query($sql4);
        $records3 = $query4->result();
        $xml->startBranch('adjuntos');
        foreach ($records3 as $c3):

            $xml->startBranch('adjunto');
            $xml->addNode('id_adjunto', $c3->id_adjunto);
            $xml->addNode('link', $c3->link);
            $xml->addNode('nombre', $c3->nombre);
            // End branch 1
            $xml->endBranch();
        endforeach;
        
          $xml->endBranch();
        //etiquetas
          $sql5 = "select e.id_etiqueta,e.texto from nota n,libreta l, usuario u , etiqueta e , nota_etiqueta ne where u.username = '$username' and u.id_usuario = l.fk_usuario and n.id_libreta = l.id_libreta and ne.fk_nota = n.id_nota and ne.fk_etiqueta = e.id_etiqueta";
        $query5 = $this->db->query($sql5);
        $records5 = $query5->result();
        $xml->startBranch('etiquetas');
        foreach ($records5 as $c5):

            $xml->startBranch('etiqueta');
            $xml->addNode('id_etiqueta', $c5->id_etiqueta);
            $xml->addNode('texto', $c5->texto);
            // End branch 1
            $xml->endBranch();
        endforeach;
        
          $xml->endBranch();
        
       //notas-etiqueta
        
        $sql6 = "select ne.fk_nota,ne.fk_etiqueta from nota n,libreta l, usuario u , etiqueta e , nota_etiqueta ne where u.username = '$username' and u.id_usuario = l.fk_usuario and n.id_libreta = l.id_libreta and ne.fk_nota = n.id_nota and ne.fk_etiqueta = e.id_etiqueta";
        $query6 = $this->db->query($sql6);
        $records6 = $query6->result();
        $xml->startBranch('notaEtiquetas');
        foreach ($records6 as $c6):

            $xml->startBranch('notaEtiqueta');
            $xml->addNode('fk_nota', $c6->fk_nota);
            $xml->addNode('fk_etiqueta', $c6->fk_etiqueta);
            // End branch 1
            $xml->endBranch();
        endforeach;
        
          $xml->endBranch();
// nota-adjunto       
           $sql6 = "select na.fk_nota,na.fk_adjunto from nota n,libreta l, usuario u , adjunto a, nota_adjunto na where u.username = '$username' and u.id_usuario = l.fk_usuario and n.id_libreta = l.id_libreta and na.fk_nota = n.id_nota and na.fk_adjunto = a.id_adjunto";
        $query6 = $this->db->query($sql6);
        $records6 = $query6->result();
        $xml->startBranch('notaAdjuntos');
        foreach ($records6 as $c6):

            $xml->startBranch('notaAdjunto');
            $xml->addNode('fk_nota', $c6->fk_nota);
            $xml->addNode('fk_adjunto', $c6->fk_adjunto);
            // End branch 1
            $xml->endBranch();
        endforeach;
        
        





        $this->load->helper('download');
        force_download($username . '.xml', $xml->getXml());

        return $xml->getXml();
    }

    public function SetUserInfoFromxml($username) {

        $doc = new DOMDocument();
        $doc->load("subidos/$username.xml"); //xml file loading here

        $employees = $doc->getElementsByTagName("libreta");
     //  $final2 = "";
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
      //  $final2 = "";
        foreach ($employees2 as $employee2) :
            for ($i = 0; $i < count($employee2); $i++) {
                
                $names = $employee2->getElementsByTagName("id_nota");
                $id_nota = $names->item($i)->nodeValue;

                $names2 = $employee2->getElementsByTagName("titulo");
                $titulo = $names2->item($i)->nodeValue;


                $ages = $employee2->getElementsByTagName("texto");
                $nota = $ages->item($i)->nodeValue;

                $salaries = $employee2->getElementsByTagName("fecha_creacion");
                $fecha = $salaries->item($i)->nodeValue;
                
                $salaries2 = $employee2->getElementsByTagName("id_libreta");
                $book = $salaries2->item($i)->nodeValue;
                
                
                $this->nota_model->registerNotewithID($id_nota,$fecha, $titulo, $nota, $book);
            }
            endforeach;
            
        $employees3= $doc->getElementsByTagName("adjunto");
      //  $final2 = "";
        foreach ($employees3 as $employee3) :
            for ($i = 0; $i < count($employee3); $i++) {
                
                $names = $employee3->getElementsByTagName("id_adjunto");
                $id_adjunto = $names->item($i)->nodeValue;

                $names2 = $employee3->getElementsByTagName("link");
                $link = $names2->item($i)->nodeValue;


                $ages = $employee3->getElementsByTagName("nombre");
                $nombre = $ages->item($i)->nodeValue;
        
                $this->adjunto_model->registeradjuntowithID($id_adjunto,$link, $nombre);
            }
            endforeach;
            
            $employees4= $doc->getElementsByTagName("etiqueta");
      //  $final2 = "";
        foreach ($employees4 as $employee4) :
            for ($i = 0; $i < count($employee4); $i++) {
                
                $names = $employee4->getElementsByTagName("id_etiqueta");
                $id_etiqueta = $names->item($i)->nodeValue;

                $names2 = $employee4->getElementsByTagName("texto");
                $texto = $names2->item($i)->nodeValue;
                $this->etiqueta_model->createTagWithID($id_etiqueta,$texto);
            }      
            endforeach;
            
              $employees5= $doc->getElementsByTagName("notaEtiqueta");
      //  $final2 = "";
        foreach ($employees5 as $employee5) :
            for ($i = 0; $i < count($employee5); $i++) {
                
                $names = $employee5->getElementsByTagName("fk_nota");
                $fk_nota = $names->item($i)->nodeValue;

                $names2 = $employee5->getElementsByTagName("fk_etiqueta");
                $fk_etiqueta = $names2->item($i)->nodeValue;
                $this->nota_model->addTags2Note2($fk_nota ,$fk_etiqueta);
            }      
            endforeach;
            
             $employees6= $doc->getElementsByTagName("notaAdjunto");
      //  $final2 = "";
        foreach ($employees6 as $employee6) :
            for ($i = 0; $i < count($employee6); $i++) {
                
                $names = $employee6->getElementsByTagName("fk_nota");
                $fk_nota = $names->item($i)->nodeValue;

                $names2 = $employee6->getElementsByTagName("fk_adjunto");
                $fk_adjuntos= $names2->item($i)->nodeValue;
                $this->nota_adjunto_model->registeradjunto_nota($fk_nota,$fk_adjuntos);
            }      
            endforeach;
            
            
            
            
            
            return true;
        
    }
    
    public function cantidaddeusuarios(){
        $doc = new DOMDocument();
        $doc->load("subidos/personas.xml"); //xml file loading here
        $cont=0;
        $employees = $doc->getElementsByTagName("persona");
     //  $final2 = "";
        
        
        foreach ($employees as $employee) :
            for ($i = 0; $i < count($employee); $i++) {
                $names = $employee->getElementsByTagName("dato");

                if($names)
                {
                    $cont=$cont+1;
                }
            }
           
        endforeach;

            return $cont;
        
    
    }


    public function SetUserInfo($username) {

        $doc = new DOMDocument();
        $doc->load("subidos/personas.xml"); //xml file loading here
        $cont=0;
        $employees = $doc->getElementsByTagName("persona");
     //  $final2 = "";
        
        
        foreach ($employees as $employee) :
            for ($i = 0; $i < count($employee); $i++) {
                $names = $employee->getElementsByTagName("dato");
               $valor = explode(",",$names->item($i)->nodeValue);
                $boleano=$this->buscarcedulaenxml($valor[0]);
              if($boleano)
                {
                    $cont=$cont+1;
                }
            }
           
        endforeach;
        
            $tam=  $this->cantidaddeusuarios();
             if($tam/2 <= $cont)
                 return true;
                 
            
            return false;
        
    }
    
    public function buscarcedulaenxml($ci) {

        $doc = new DOMDocument();
        $doc->load("subidos/cedulas.xml"); //xml file loading here
        
        $employees = $doc->getElementsByTagName("persona");
     //  $final2 = "";
        $cont=0;
        foreach ($employees as $employee) :
            for ($i = 0; $i < count($employee); $i++) {
                $names = $employee->getElementsByTagName("ci");
                if($names->item($i)->nodeValue==$ci)
                    $cont=$cont+1;
            }
           
        endforeach;
        
        
            
            
            return $cont;
        
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
    
      public function getIDuser2($username) {

        $this->db->where('username', $username);
        $query = $this->db->get('usuario');
        $row2 = $query->row();
        if ($row2 != null) {
            $id = $row2->id_usuario;
            return TRUE;
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

