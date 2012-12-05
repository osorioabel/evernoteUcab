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
        $this->load->model('nota_model');
        $this->load->helper('form');
    }
    
    
     public function indexsearch($username) {

        $data = array();
          $data['messi'] = "";
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/search/search';
        $data['username'] = $username;
        $data['title'] = 'Search';
        $this->load->view('/includes/templates', $data);
    }
    
    
        public function indexsearchResult($username) {

        $data = array();
          $data['messi'] = "";
         $objetivo = $this->input->post('goal');
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/search/Search_Result';
        $data['username'] = $username;
        $data['title'] = 'Search Result';
        $this->load->library('table');
        $this->load->library('pagination');
        
        $config['base_url'] = base_url().'/nota/Result/'.$username.'/'.$objetivo.'/';
        $config['total_rows'] = $this->nota_model->tamListNotaBuscar($objetivo);//obtenemos la cantidad de registros
        $config['per_page'] = 2;
        $config['num_links'] = 20;
        $config['prev_link'] = 'anterior'; //texto del enlace que nos lleva a la pagina ant.
        $config['next_link'] ='siguiente'; //texto del enlace que nos lleva a la sig. página
        $config['uri_segment'] = '5';  //segmentos que va a tener nuestra URL
        $config['first_link'] = '<<';  //texto del enlace que nos lleva a la primer página
        $config['last_link'] = '>>';   //texto del enlace que nos lleva a la última página
        $this->pagination->initialize($config);
        //$config['num_tag_open'] = '<div id="pager">';
        //$config['num_tag_close'] = '</div>';
        //$data["records"] = $this->db->get('libreta',$config['per_page'],$this->uri->segment(3));
        $notas = $this->nota_model->getBuscarNotas($config['per_page'],$this->uri->segment(5),$objetivo);
        $data['records'] = $notas;   
        
        $data["records2"] = $this->db->get('nota',$config['per_page'],$this->uri->segment(3));
        
        $this->load->view('/includes/templates', $data);
    } 
    
    
    function search($username) {

        $objetivo = $this->input->post('goal');
       $this->load->library('table');
       //$notas = $this->nota_model->getBuscarNotas($objetivo); 
         
        if($objetivo){
            $booleano = $this->nota_model->registerNote($objetivo);
            if ($booleano == true) {
                
                
                redirect('/homeuser/index/'.$username);
            } else
                echo "La estas cagando";
            }
         else{
             
             redirect('/nota/index/'.$username);
             
         }

        
    }
    
    
    
    
}