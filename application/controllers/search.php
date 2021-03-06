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
    
    private $variable = '';

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
        $this->load->model('usuario_model');
        $this->load->helper('form');
         $this->load->library('table');
        $this->load->library('pagination');
    }
    
     /**
     *  Funcion indexsearch() se encarga 
     * de elaborar  y construir la vista de la busqueda
     *  @param String $username usuario actual
     * @category	Controller
     */
    
     public function indexsearch($username) {

        $data = array();
          $data['messi'] = "";
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/search/search';
        $data['username'] = $username;
        $data['title'] = 'Search';
        $this->load->view('/includes/templates', $data);
    }
    
     /**
     *  Funcion indexsearchresult() se encarga
     * de mostrar la busqueda a realizada
     *  @param String $username usuario actual
     * @category	Controller
     */
    
        public function indexsearchresult($username) {
          
        // $username = $this->input->post('username_login');
        
         $data = array();
        $data['messi'] = "";
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/search/search_result';
        $data['username'] = $username;
       $data['busqueda']=$this->input->post('goal');
        
         $usuario = new Usuario_Model();
         
        $usuario = $this->usuario_model->getUser($username);
      
        
        // aca se llama a funcion para cargar las libretas del usuario
        // esta variable trae un codigo HTML para que se realice 
        // su visualizacion en la interfaz de Modificar 
       // $this->variable = $this->input->post('goal');
        //$data['objetivo'] = $objetivo;
        $data['title'] = 'Search';
        $this->load->library('pagination');
        $this->load->library('table');
        
        $config['base_url'] = base_url().'/search/indexsearchresult2/'.$username.'/'.$this->input->post('goal').'/' ;
        $config['per_page'] = 10;
        $config['num_links'] = 20;
        $config['total_rows'] = $this->libreta_model->cantNotas($config['per_page'], $this->uri->segment(4),$username);
       
        $id_user = $this->usuario_model->getId_user();
       
        
        $config['prev_link'] = 'anterior'; //texto del enlace que nos lleva a la pagina ant.
        $config['next_link'] ='siguiente'; //texto del enlace que nos lleva a la sig. página
        $config['uri_segment'] = '5';  //segmentos que va a tener nuestra URL
        $config['first_link'] = '<<';  //texto del enlace que nos lleva a la primer página
        $config['last_link'] = '>>';   //texto del enlace que nos lleva a la última página
        $this->pagination->initialize($config);
        //$config['num_tag_open'] = '<div id="pager">';
        //$config['num_tag_close'] = '</div>';
        //$data["records"] = $this->db->get('libreta',$config['per_page'],$this->uri->segment(3));
        
        
        $notas = $this->nota_model->getBuscarNotas($config['per_page'], $this->uri->segment(4), $data['busqueda'],$username);
         $data['records'] = $notas;
       
        //$data['upload'] = $this->uploadNotebookViewModify($username);
        $this->load->view('/includes/templates', $data);
        }
    
         /**
     *  Funcion indexsearchresult2() se encarga
     * de mostrar la busqueda a realizada
     *  @param String $username usuario actual
     *  @param String $value palabra que se esta buscando
     * @category	Controller
     */
    public function indexsearchresult2($username,$value) {
          
        // $username = $this->input->post('username_login');
        
         $data = array();
        $data['messi'] = "";
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/search/search_result';
        $data['username'] = $username;
        $data['busqueda']=$value;
        $usuario = new Usuario_Model();
         
        $usuario = $this->usuario_model->getUser($username);
         
        
        
        // aca se llama a funcion para cargar las libretas del usuario
        // esta variable trae un codigo HTML para que se realice 
        // su visualizacion en la interfaz de Modificar 
       // $this->variable = $this->input->post('goal');
        //$data['objetivo'] = $objetivo;
        $data['title'] = 'Search';
        $this->load->library('pagination');
        $this->load->library('table');
        
         $config['base_url'] = base_url().'/search/indexsearchresult2/'.$username.'/'.$value.'/' ;
        $config['total_rows'] = $this->libreta_model->cantNotas($config['per_page'], $this->uri->segment(4),$username);
       $config['per_page'] = 10;
        $config['num_links'] = 20;
        $id_user = $this->usuario_model->getId_user();
        
        $config['prev_link'] = 'anterior'; //texto del enlace que nos lleva a la pagina ant.
        $config['next_link'] ='siguiente'; //texto del enlace que nos lleva a la sig. página
        $config['uri_segment'] = '5';  //segmentos que va a tener nuestra URL
        $config['first_link'] = '<<';  //texto del enlace que nos lleva a la primer página
        $config['last_link'] = '>>';   //texto del enlace que nos lleva a la última página
        $this->pagination->initialize($config);
        //$config['num_tag_open'] = '<div id="pager">';
        //$config['num_tag_close'] = '</div>';
        //$data["records"] = $this->db->get('libreta',$config['per_page'],$this->uri->segment(3));
        
        
        $notas = $this->nota_model->getBuscarNotas($config['per_page'], $this->uri->segment(4),$username);
        $data['records'] = $notas;
        
        //$data['upload'] = $this->uploadNotebookViewModify($username);
        $this->load->view('/includes/templates', $data);
        }
        
          /**
     * Funcion indexshowresult() se encarga
     * de mostrar la nota seleccionada 
     *  @param String $value palabra que se esta buscando
     *  @param String $id id de la nota
     * @category	Controller
     */ 
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
        $config['per_page'] = 10;
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
        $notastag = $this->nota_model->gettingnotatags($id);
        $data['records2'] = $notastag;
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