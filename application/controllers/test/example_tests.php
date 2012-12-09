<?php

require_once(APPPATH . '/controllers/test/Toast.php');

/**
 * EvernoteUcab
 * h
 * An Cloud Computering, Cloud storage base web app 
 * for remeinders, Notebooks and MORE
 *
 * @package		EvernoteUcab
 * @author		Abel Osorio Hector Matheus Luis Tovar
 * @copyright	        Copyright (c) 2012, 
 * @filesource
 */
class Example_tests extends Toast {
    
    
      private $create_name ;
      private $create_lastname ;
      private $create_username;
      private $create_password ;
      private $create_email ; 
      private $loginusuario;
      private $loginpass; 
      private $loginusuario2 ;
      private $loginpass2;
      private $objetivo1;
      private $objetivo2 ;      
      private $numeroRegistros;
      private $inicio;
      private $titulo ;
      private $nota ;
      private $username;
      private $book;
       
      

               
       

    /**
     *  Funcion Constructor del controlador, se realizan cargas de 
     * algunos modelos y helpers usuados en el funcionamiento de 
     * el controlador 
     *  
     * @category	Controller
     */
    function Example_tests() {
        parent::Toast(__FILE__);
        parent::__construct(__FILE__);
        $this->load->model("usuario_model");
        $this->load->model("nota_model");
        $this->load->model("dropbox_model");
        $this->load->model("adjunto_model");
        
        
        
        // Load any models, libraries etc. you need here
    }

    /**
     *  Funcion Constructor del controlador, se realizan cargas de 
     * algunos modelos y helpers usuados en el funcionamiento de 
     * el controlador 
     *  
     * @category	Controller
     */
    function _pre() {
       $this->usuario_model->deleteuser("fago");
       $this->setCreate_name("Francisco");
       $this->setCreate_lastname("Gomez");
       $this->setCreate_username("fago");
       $this->setCreate_password("123456");
       $this->setCreate_email("fago@gmail.com");
       $this->setLoginusuario("osorioabel");
       $this->setLoginpass("490263");
       $this->setLoginusuario2("PrubaUnitaria");
       $this->setLoginpass2("490263");
       $this->setObjetivo1("z");
       $this->setObjetivo2("Diario");
       $this->setNumeroRegistros("6");
       $this->setInicio("5");
       $this->setTitulo("Nota de Prueba");
       $this->setNota("Se hace Prueba de Creacion de una nota y ponerle 3 adjuntos ");
       $this->setUsername("osorioabel");
       $this->setBook("999");
     
    }

    /**
     *  Funcion Constructor del controlador, se realizan cargas de 
     * algunos modelos y helpers usuados en el funcionamiento de 
     * el controlador 
     *  
     * @category	Controller
     */
    function _post() {
        
       $this->usuario_model->deleteuser("fago");
       $this->nota_model->deletenota();
         $this->setCreate_name("");
       $this->setCreate_lastname("");
       $this->setCreate_username("");
       $this->setCreate_password("");
       $this->setCreate_email(".com");
       $this->setLoginusuario("");
       $this->setLoginpass("");
       $this->setLoginusuario2("");
       $this->setLoginpass2("");
       $this->setObjetivo1("");
       $this->setObjetivo2("");
       $this->setNumeroRegistros("");
       $this->setInicio("");
       $this->setTitulo("");
       $this->setNota("");
       $this->setUsername("");
       $this->setBook("");
     
        
    }

    /**
     *  Funcion Constructor del controlador, se realizan cargas de 
     * algunos modelos y helpers usuados en el funcionamiento de 
     * el controlador 
     *  
     * @category	Controller
     */
    function test_login_succesfull() {

        // setting up variables for test 

       
        $booleano = $this->usuario_model->login($this->loginusuario, $this->loginpass);
        $this->_assert_true($booleano);
        $this->_assert_equals($booleano, true);
        $this->message = 'Prueba Unitaria Satisfactoria el usuario se encuentra registrado en el sistema';
    }

    function test_login_fail() {

       
        $booleano = $this->usuario_model->login($this->loginusuario2, $this->loginpass2);
        $this->_assert_false($booleano);
        $this->_assert_equals($booleano, false);
        $this->message = 'Prueba Unitaria Satisfactoria el usuario no se encuentra registrado en el sistema';
    }

    function test_register_succesful() {


       
        $booleano = $this->usuario_model->register($this->create_name, $this->create_lastname, $this->create_username, $this->create_email, $this->create_password);
        $this->_assert_true($booleano);
        $this->_assert_equals($booleano, true);
        $this->message = 'Prueba Unitaria Satisfactoria el usuario se encuentra registrado en el sistema';
    }

    function test_register_fail() {
        
        $booleano = $this->usuario_model->register($this->create_name, $this->create_lastname, $this->username, $this->create_email, $this->create_password);
        $this->_assert_false($booleano);
        $this->_assert_equals($booleano, false);
        $this->message = 'Prueba Unitaria Satisfactoria el usuario no se puede  registrar en el sistema';
    }
    
    function test_dropbox_conection_foldercreation_succesfull() {

       $retorno  =$this->dropbox_model->test_dropbox($this->loginusuario); 
       $this->_assert_not_empty($retorno);
        $this->message = 'Prueba Unitaria Satisfactoria el Servicio de Almacenamiento Dropbox esta activo y se ha podido crear la carpeta';
       
    }
    
    function test_createnotewith3attach() {

        $notacreada=$this->nota_model->registerNote($this->username, $this->titulo, $this->nota, $this->book);
        
        $this->_assert_true($notacreada);
        $this->message = 'Prueba Unitaria Satisfactoria el Servicio de Almacenamiento Dropbox esta activo y se ha podido crear la carpeta';
    }
    
    
    function test_searchingwithaexistingString() {

       
       
       $busqueda=array();
        $busqueda=$this->nota_model->getBuscarNotas($this->numeroRegistros,  $this->inicio,  $this->objetivo1);
        $this->_assert_not_empty($busqueda);
        
        $this->message = 'Prueba Unitaria Satisfactoria se ha encontrado con el buscador la cadena expecificada ';
    }
    function test_searchingwithoutaexistingString() {

       
      
         $busqueda=array();
         $busqueda=$this->nota_model->getBuscarNotas($this->numeroRegistros,  $this->inicio,  $this->objetivo2);
        $this->_assert_empty($busqueda);
        $this->message = 'Prueba Unitaria Satisfactoria se ha encontrado con el buscador la cadena expecificada ';
    }
    
    
    
    
      public function getCreate_name() {
            return $this->create_name;
        }

        public function setCreate_name($create_name) {
            $this->create_name = $create_name;
        }

        public function getCreate_lastname() {
            return $this->create_lastname;
        }

        public function setCreate_lastname($create_lastname) {
            $this->create_lastname = $create_lastname;
        }

        public function getCreate_username() {
            return $this->create_username;
        }

        public function setCreate_username($create_username) {
            $this->create_username = $create_username;
        }

        public function getCreate_password() {
            return $this->create_password;
        }

        public function setCreate_password($create_password) {
            $this->create_password = $create_password;
        }

        public function getCreate_email() {
            return $this->create_email;
        }

        public function setCreate_email($create_email) {
            $this->create_email = $create_email;
        }

        public function getLoginusuario() {
            return $this->loginusuario;
        }

        public function setLoginusuario($loginusuario) {
            $this->loginusuario = $loginusuario;
        }

        public function getLoginpass() {
            return $this->loginpass;
        }

        public function setLoginpass($loginpass) {
            $this->loginpass = $loginpass;
        }

        public function getLoginusuario2() {
            return $this->loginusuario2;
        }

        public function setLoginusuario2($loginusuario2) {
            $this->loginusuario2 = $loginusuario2;
        }

        public function getLoginpass2() {
            return $this->loginpass2;
        }

        public function setLoginpass2($loginpass2) {
            $this->loginpass2 = $loginpass2;
        }

        public function getObjetivo1() {
            return $this->objetivo1;
        }

        public function setObjetivo1($objetivo1) {
            $this->objetivo1 = $objetivo1;
        }

        public function getObjetivo2() {
            return $this->objetivo2;
        }

        public function setObjetivo2($objetivo2) {
            $this->objetivo2 = $objetivo2;
        }

        public function getNumeroRegistros() {
            return $this->numeroRegistros;
        }

        public function setNumeroRegistros($numeroRegistros) {
            $this->numeroRegistros = $numeroRegistros;
        }

        public function getInicio() {
            return $this->inicio;
        }

        public function setInicio($inicio) {
            $this->inicio = $inicio;
        }

        public function getTitulo() {
            return $this->titulo;
        }

        public function setTitulo($titulo) {
            $this->titulo = $titulo;
        }

        public function getNota() {
            return $this->nota;
        }

        public function setNota($nota) {
            $this->nota = $nota;
        }

        public function getUsername() {
            return $this->username;
        }

        public function setUsername($username) {
            $this->username = $username;
        }

        public function getBook() {
            return $this->book;
        }

        public function setBook($book) {
            $this->book = $book;
        }
   
    
    
    
    
    
    
    
    
}

// End of file example_test.php */
// Location: ./system/application/controllers/test/example_test.php */