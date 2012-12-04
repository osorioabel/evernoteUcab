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
 * @copyright                           Copyright (c) 2012, 
 * @filesource
 */

class search extends CI_Controller {

    /**
     *  Funcion Constructor del controlador, se realizan cargas de 
     * algunos modelos y helpers usuados en el funcionamiento de 
     * el controlador 
     *  
     * @category	Controller
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('libreta_model');
    }
    
    
     public function indexsearch() {

        $data = array();
        $data['messi'] = "";
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/search/search';
        $data['username'] = $this->session->userdata('username');
        $data['title'] = 'Search';
        $this->load->view('/includes/templates', $data);
    }
    
    
    
    
}