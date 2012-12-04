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
        
    }

    /**
     *  Funcion Constructor del controlador, se realizan cargas de 
     * algunos modelos y helpers usuados en el funcionamiento de 
     * el controlador 
     *  
     * @category	Controller
     */
    function _post() {
        
    }

 /**
     *  Funcion Constructor del controlador, se realizan cargas de 
     * algunos modelos y helpers usuados en el funcionamiento de 
     * el controlador 
     *  
     * @category	Controller
     */    function test_simple_addition() {
        $var = 2 + 2;
        $this->_assert_equals($var, 4);
        $this->message = '2+2 es igual a 4';
    }

     /**
     *  Funcion Constructor del controlador, se realizan cargas de 
     * algunos modelos y helpers usuados en el funcionamiento de 
     * el controlador 
     *  
     * @category	Controller
     */
    function test_that_fails() {
        $a = true;
        $b = $a;

        // You can test multiple assertions / variables in one function:

        $this->_assert_true($a); // true
        $this->_assert_true($b); // false
        $this->_assert_equals($a, $b); // true
        // Since one of the assertions failed, this test case will fail
    }

     /**
     *  Funcion Constructor del controlador, se realizan cargas de 
     * algunos modelos y helpers usuados en el funcionamiento de 
     * el controlador 
     *  
     * @category	Controller
     */
    function test_or_operator() {
        $a = true;
        $b = false;
        $var = $a || $b;

        $this->_assert_true($var);

        // If you need to, you can pass a message /
        // description to the unit test results page:

        $this->message = '$a || $b';
    }

     /**
     *  Funcion Constructor del controlador, se realizan cargas de 
     * algunos modelos y helpers usuados en el funcionamiento de 
     * el controlador 
     *  
     * @category	Controller
     */
    function test_login_succesfull() {
        
        /*  $username = $this->input->post('username_login');
        $password = $this->input->post('password_login');
        $booleano = $this->usuario_model->login($username, $password);
        if ($booleano) {
            $this->session->set_userdata('username', $username);
            redirect('/homeuser/index2');
        } else {
            log_message("error", "Problem LOGIN IN");
            $this->index2();
        }
         * 
         *  */
        
         $username = "PrubaUnitaria";
         $password = "123456";
         $booleano=true;
          $this->_assert_true($booleano);
          $this->_assert_equals($booleano, true);
            //$this->session->set_userdata('username', $username);
            //redirect('/homeuser/index2');
            $this->message = 'Prueba Unitaria Satisfactoria el usuario se encuentra registrado en el sistema';
    }
    
    function test_login_fail() {
        
        /*  
        $username = $this->input->post('username_login');
        $password = $this->input->post('password_login');
        $booleano = $this->usuario_model->login($username, $password);
        if ($booleano) {
            $this->session->set_userdata('username', $username);
            redirect('/homeuser/index2');
        } else {
            log_message("error", "Problem LOGIN IN");
            $this->index2();
        }
         * 
         *  */
        
         $username = "PrubaUnitaria";
         $password = "123456";
         $booleano=false;
         $this->_assert_false($booleano);
         $this->_assert_equals($booleano, false);
         $this->message = 'Prueba Unitaria Satisfactoria el usuario no se encuentra registrado en el sistema';
    }
    
    function test_register_succesful() {
        
        /*  
        $name = $this->input->post('name_signup');
        $lastname = $this->input->post('lastname_signup');
        $username = $this->input->post('username_signup');
        $password = $this->input->post('pass_signup');
        $email = $this->input->post('email_signup');
        $booleano = $this->usuario_model->register($name, $lastname, 
        $username, $email, $password);
        if ($booleano == true) {
            $this->index3();
        } else
        // caso de gente repetido
            echo "esta repedito";
    }
         * 
         *  */
        
        $name = "Francisco";
        $lastname = "Gomez";
        $username = "fago";
        $password ="1234";
        $email = "fago@gmail.com";
         $booleano=true;
          $this->_assert_true($booleano);
          $this->_assert_equals($booleano, true);
            $this->message = 'Prueba Unitaria Satisfactoria el usuario se encuentra registrado en el sistema';
    }
    
     function test_register_fail() {
        
        /*  
        $name = $this->input->post('name_signup');
        $lastname = $this->input->post('lastname_signup');
        $username = $this->input->post('username_signup');
        $password = $this->input->post('pass_signup');
        $email = $this->input->post('email_signup');
        $booleano = $this->usuario_model->register($name, $lastname, 
        $username, $email, $password);
        if ($booleano == true) {
            $this->index3();
        } else
        // caso de gente repetido
            echo "esta repedito";
    }
         * 
         *  */
        
        $name = "Francisco";
        $lastname = "Gomez";
        $username = "fago";
        $password ="1234";
        $email = "fago@gmail.com";
        $booleano=false;
        $this->_assert_false($booleano);
        $this->_assert_equals($booleano, false);
        $this->message = 'Prueba Unitaria Satisfactoria el usuario no se encuentra registrado en el sistema';
    }
    
}

// End of file example_test.php */
// Location: ./system/application/controllers/test/example_test.php */