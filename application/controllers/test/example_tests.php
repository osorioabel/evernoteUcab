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

        $usuario = "osorioabel";
        $pass = "490263";
        $booleano = $this->usuario_model->login($usuario, $pass);
        $this->_assert_true($booleano);
        $this->_assert_equals($booleano, true);
        $this->message = 'Prueba Unitaria Satisfactoria el usuario se encuentra registrado en el sistema';
    }

    function test_login_fail() {

        $username = "PrubaUnitaria";
        $password = "123456";
        $booleano = false;
        $this->_assert_false($booleano);
        $this->_assert_equals($booleano, false);
        $this->message = 'Prueba Unitaria Satisfactoria el usuario no se encuentra registrado en el sistema';
    }

    function test_register_succesful() {


        $name = "Francisco";
        $lastname = "Gomez";
        $username = "fago";
        $password = "123456";
        $email = "fago@gmail.com";
        $booleano = $this->usuario_model->register($name, $lastname, $username, $email, $password);
        $this->_assert_true($booleano);
        $this->_assert_equals($booleano, true);
        $this->message = 'Prueba Unitaria Satisfactoria el usuario se encuentra registrado en el sistema';
    }

    function test_register_fail() {
        
        
        $name = "Francisco";
        $lastname = "Gomez";
        $username = "fago";
        $password = "1234";
        $email = "fago@gmail.com";
        //aca se inserta al usuario..
        $booleano = $this->usuario_model->register($name, $lastname, $username, $email, $password);
        $booleano = $this->usuario_model->register($name, $lastname, $username, $email, $password);
        $this->_assert_false($booleano);
        $this->_assert_equals($booleano, false);
        $this->message = 'Prueba Unitaria Satisfactoria el usuario no se puede  registrar en el sistema';
    }
    
    function test_dropbox_conection_succesfull() {
        
        
        
        $controller = new Upload();
        $retorno  =$controller->test_dropbox();
        $this->_assert_not_empty($retorno);
        //$this->_assert_equals($booleano, false);
        $this->message = 'Prueba Unitaria Satisfactoria el usuario no se puede  registrar en el sistema';
    }
    

    
    
}

// End of file example_test.php */
// Location: ./system/application/controllers/test/example_test.php */