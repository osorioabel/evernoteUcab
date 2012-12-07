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
         $this->load->library('table');
        $this->load->library('pagination');
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
    
    
        public function indexsearchresult($username) {
         $data = array();
        $data['messi'] = "";
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/search/search_result';
        $data['username'] = $username;
        // aca se llama a funcion para cargar las libretas del usuario
        // esta variable trae un codigo HTML para que se realice 
        // su visualizacion en la interfaz de Modificar 
        $data['title'] = 'Search';
        $this->load->library('pagination');
        $this->load->library('table');
        
         $config['base_url'] = base_url().'/search/indexsearchresult/'.$username.'/';
        $config['total_rows'] = $this->nota_model->tamListNotaBuscar();//obtenemos la cantidad de registros
        $config['per_page'] = 2;
        $config['num_links'] = 20;
        
        $config['prev_link'] = 'anterior'; //texto del enlace que nos lleva a la pagina ant.
        $config['next_link'] ='siguiente'; //texto del enlace que nos lleva a la sig. página
        $config['uri_segment'] = '4';  //segmentos que va a tener nuestra URL
        $config['first_link'] = '<<';  //texto del enlace que nos lleva a la primer página
        $config['last_link'] = '>>';   //texto del enlace que nos lleva a la última página
        $this->pagination->initialize($config);
        //$config['num_tag_open'] = '<div id="pager">';
        //$config['num_tag_close'] = '</div>';
        //$data["records"] = $this->db->get('libreta',$config['per_page'],$this->uri->segment(3));
        
        
        $notas = $this->nota_model->getBuscarNotas($config['per_page'],$this->uri->segment(4));
        $data['records'] = $notas;
        //$data['upload'] = $this->uploadNotebookViewModify($username);
        $this->load->view('/includes/templates', $data);
        }
    
    
      function indexshowresult($username, $id) {

        $data = array();
        $data['messi'] = "";
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/search/search_detail';
        $data['username'] = $username;
        $data['nota'] = $id;
        $data['title'] = 'Detail Note';
        
        $this->load->library('pagination');
        
        $config['base_url'] = base_url().'/nota/Selected/'.$username.'/'.$id.'/';
        $config['total_rows'] = $this->nota_model->tamListNotaBuscar($id);//obtenemos la cantidad de registros
        $config['per_page'] = 2;
        $config['num_links'] = 20;
        $config['prev_link'] = 'anterior'; //texto del enlace que nos lleva a la pagina ant.
        $config['next_link'] ='siguiente'; //texto del enlace que nos lleva a la sig. página
        $config['uri_segment'] = '2';  //segmentos que va a tener nuestra URL
        $config['first_link'] = '<<';  //texto del enlace que nos lleva a la primer página
        $config['last_link'] = '>>';   //texto del enlace que nos lleva a la última página
        $this->pagination->initialize($config);
        //$config['num_tag_open'] = '<div id="pager">';
        //$config['num_tag_close'] = '</div>';
        //$data["records"] = $this->db->get('libreta',$config['per_page'],$this->uri->segment(3));
        $notas = $this->nota_model->getBuscarNotasSelected($config['per_page'],$this->uri->segment(5),$id);
        $data['records'] = $notas;   
        
        
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