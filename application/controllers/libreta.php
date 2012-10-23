<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class libreta extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('libreta_model');
        $this->load->helper('form');
        
    }
    
     function index($username) {

        $data = array();
        $data['messi']="";
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/libreria/libreria';
        $data['username'] = $username;
        $data['title'] = 'Create Book';
        $this->load->view('/includes/templates', $data);
    }
    
    
         function indexModify($username) {

        $data = array();
        $data['messi']="";
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/libreria/Libreta_Modificar';
        $data['username'] = $username;
        $data['upload']= $this->uploadNotebookViewModify($username);
        //echo $data['main_content'];
        $data['title'] = 'Modify Book';
        $this->load->view('/includes/templates', $data);
    }
    
        function indexModify2($username,$id) {
           
        $data = array();
        $data['messi']="";
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/libreria/Libreta_Modificar_2';
        $data['username'] = $username;
        $data['libreta'] = $id;
        $data['title'] = 'Modify Book';
        $this->load->view('/includes/templates', $data);
    }
    
     function indexDelete($username) {
           
        $data = array();
        $data['messi']="";
        $data['upload']= $this->uploadNotebookViewDelete($username);
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/libreria/Libreta_Eliminar';
        $data['username'] = $username;
        $data['title'] = 'Delete Book';
        $this->load->view('/includes/templates', $data);
    }
    
      function indexSelect($username) {
           
        $data = array();
        $data['messi']="";
        $data['upload']= $this->uploadNotebookView($username);
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/libreria/Libreta_Select';
        $data['username'] = $username;
        $data['title'] = 'Your Books';
        $this->load->view('/includes/templates', $data);
    }
    
          function indexSelectConsulta($username) {
           
        $data = array();
        $data['messi']="";
        $data['upload3']= $this->uploadNotebookView2($username);
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/libreria/Select_Libreta_Consulta';
        $data['username'] = $username;
        //$data['libreta'] = $id;
        $data['title'] = 'Your Books';
        $this->load->view('/includes/templates', $data);
    }
    
    
    
    
     function AddBook($username) {
        $titulo = $this->input->post('tituloBook');
        $descripcion = $this->input->post('descrip');
        $booleano = $this->libreta_model->registerBook($username,$titulo,$descripcion);
      if ($booleano == true) {
            $this->index($username);
        } else
       
            echo "La estas cagando";
     }
    
     function ModifyBook($username,$libreta) {
         $tituloLibreta = $this->input->post('titulo');
         $descripLibreta = $this->input->post('descrip');
       
         $booleano = $this->libreta_model->modificarLibreta($username,$libreta,$tituloLibreta, $descripLibreta);
        
        if ($booleano == true) {
            $this->indexModify($username,'');
        } else
        // caso de gente repetido
            echo "HOLA";
     }
        function DeleteBook($username,$libreta2) {
         
       

        $booleano = $this->libreta_model->BorrarLibreta($username,$libreta2);
        
        if ($booleano == true) {
            $this->indexDelete($username,'');
        } else
        // caso de gente repetido
            echo "HOLA";
     }
     
     function a(){
         $this->libreta_model->libretaAtIndex(0, 'lucholj');
     }


     function uploadNotebookViewDelete($username) {
     $base_url=  base_url().'images/book.png';
     $return ='';
        for ($i = 0; $i < $this->libreta_model->tamListLibreta($username) ; $i++) {
            
            
            $libreta= new Libreta_Model();
            $libreta= $libreta->libretaAtIndex($i, $username);
            
            $nombre= $libreta->getNombre();
            //$libreta->setNombre('abel');
            $id= $libreta->getId_libreta();
            $fecha= $libreta->getFecha();
            $descripcion= $libreta->getDescripcion();
            
            
            $attributes = array('id' => 'sc-modify-form');
            $ref= base_url().'Libreta/indexDelete/'.$username.'>';
             $boton= base_url().'Libreta/DeleteBook/'.$username.'/'.$id;
             $ref2= base_url().'Libreta/indexDelete/'.$username;
            $result =" 
            
            <?php 
               echo form_open('/Libreta/DeleteBook/'$username'/'$nombre','$attributes');
                ?>
                 <div class='project'>
                          <h1><a href=$ref $nombre </a></h1>
                                <!-- shadow -->
                                <div class='project-shadow'>
                                    <!-- project-thumb -->
                                    <div class='project-thumbnail'>
            

                                        <!-- meta -->
                                        <ul class='meta'>
                                            <li><strong>Project date</strong> $fecha </li>
                                            <li><strong>username</strong> <a href='#'> $username </a></li>
                                        </ul>
                                        <!-- ENDS meta -->

                                        <a href=$ref2 class='cover'><img src='$base_url'  alt='Feature image' /></a>
                                    </div>
                                    <!-- ENDS project-thumb -->

                                    <div class='the-excerpt'>
                                         $descripcion 
                                    </div>	
                                   
             <a href=$boton class='read-more link-button' name='<?php echo $nombre ?>' id='<?php echo $nombre ?>'><span>Delete it</span></a>                        
            </div>
                                <!-- ENDS shadow -->
                            </div>
                            <!-- ENDS project -->
              <?php echo form_close(); ?>
             
                 ";
            
          
            $return = $result.$return;
        }
        return $return;
    }
     
    function uploadNotebookView($username) {
     $base_url=  base_url().'images/book.png';
     $return ='';
        for ($i = 0; $i < $this->libreta_model->tamListLibreta($username) ; $i++) {
            
            
            $libreta= new Libreta_Model();
            $libreta= $libreta->libretaAtIndex($i, $username);
            
            $nombre= $libreta->getNombre();
            //$libreta->setNombre('abel');
            $id= $libreta->getId_libreta();
            $fecha= $libreta->getFecha();
            $descripcion= $libreta->getDescripcion();
            
            
            $attributes = array('id' => 'sc-modify-form');
            
           
            $ref= base_url().'Nota/SelectNote/'.$username.'/'.$id.'>';
             $ref2= base_url().'Libreta/indexSelect/'.$username.'/'.$nombre;
            
            $result =" 
            
            <?php 
               echo form_open('/Libreta/indexSelect/'$username'/'$nombre','$attributes');
                ?>
                 <div class='project'>
                          <h1><a href=$ref $nombre </a></h1>
                                <!-- shadow -->
                                <div class='project-shadow'>
                                    <!-- project-thumb -->
                                    <div class='project-thumbnail'>
            

                                        <!-- meta -->
                                        <ul class='meta'>
                                            <li><strong>Project date</strong> $fecha </li>
                                            <li><strong>username</strong> <a href='#'> $username </a></li>
                                        </ul>
                                        <!-- ENDS meta -->

                                        <a href=$ref2 class='cover'><img src='$base_url'  alt='Feature image' /></a>
                                    </div>
                                    <!-- ENDS project-thumb -->

                                    <div class='the-excerpt'>
                                         $descripcion 
                                    </div>	
                                 
             </div>
                                <!-- ENDS shadow -->
                            </div>
                            <!-- ENDS project -->
              <?php echo form_close(); ?>
             
                 ";
            
          
            $return = $result.$return;
        }
        return $return;
    }
    
     function uploadNotebookViewModify($username) {
     $base_url=  base_url().'images/book.png';
     $return ='';
        for ($i = 0; $i < $this->libreta_model->tamListLibreta($username) ; $i++) {
            
            
            $libreta= new Libreta_Model();
            $libreta= $libreta->libretaAtIndex($i, $username);
            $id = $libreta->getId_libreta();
            $nombre= $libreta->getNombre();
            //$libreta->setNombre('abel');
           
            $fecha= $libreta->getFecha();
            $descripcion= $libreta->getDescripcion();
            
            
            $attributes = array('id' => 'sc-modify-form');
            
            
            $ref= base_url().'Libreta/indexModify2/'.$username.'/'.$id.'>';
            $ref2= base_url().'Libreta/indexModify2/'.$username.'/'.$id;
            
            $result =" 
            
            <?php 
               echo form_open('/Libreta/indexModify2/'$username'/'$nombre','$attributes');
                ?>
                 <div class='project'>
                          <h1><a href=<h1><a href=$ref $nombre </a></h1></a></h1>
                                <!-- shadow -->
                                <div class='project-shadow'>
                                    <!-- project-thumb -->
                                    <div class='project-thumbnail'>
            

                                        <!-- meta -->
                                        <ul class='meta'>
                                            <li><strong>Project date</strong> $fecha </li>
                                            <li><strong>username</strong> <a href='#'> $username </a></li>
                                        </ul>
                                        <!-- ENDS meta -->

                                        <a href=$ref2 class='cover'><img src='$base_url'  alt='Feature image' /></a>
                                    </div>
                                    <!-- ENDS project-thumb -->

                                    <div class='the-excerpt'>
                                        $descripcion 
                                    </div>	
                                   
             </div>
                                <!-- ENDS shadow -->
                            </div>
                            <!-- ENDS project -->
              <?php echo form_close(); ?>
             
                 ";
            
          
            $return = $result.$return;
        }
        return $return;
    }
    
    
      function uploadNotebookView2($username) {
     $base_url=  base_url().'images/book.png';
     $return ='';
        for ($i = 0; $i < $this->libreta_model->tamListLibreta($username) ; $i++) {
            
            
            $libreta= new Libreta_Model();
            $libreta= $libreta->libretaAtIndex($i, $username);
            
            $nombre= $libreta->getNombre();
            //$libreta->setNombre('abel');
            $id= $libreta->getId_libreta();
            $fecha= $libreta->getFecha();
            $descripcion= $libreta->getDescripcion();
            
            
            $attributes = array('id' => 'sc-modify-form');
            
           
            $ref= base_url().'nota/SelectNoteConsulta/'.$username.'/'.$id.'>';
             $ref2= base_url().'Libreta/indexSelect/'.$username.'/'.$nombre;
            
            $result =" 
            
            <?php 
               echo form_open('/Libreta/indexSelect/'$username'/'$nombre','$attributes');
                ?>
                 <div class='project'>
                          <h1><a href=$ref $nombre </a></h1>
                                <!-- shadow -->
                                <div class='project-shadow'>
                                    <!-- project-thumb -->
                                    <div class='project-thumbnail'>
            

                                        <!-- meta -->
                                        <ul class='meta'>
                                            <li><strong>Project date</strong> $fecha </li>
                                            <li><strong>username</strong> <a href='#'> $username </a></li>
                                        </ul>
                                        <!-- ENDS meta -->

                                        <a href=$ref2 class='cover'><img src='$base_url'  alt='Feature image' /></a>
                                    </div>
                                    <!-- ENDS project-thumb -->

                                    <div class='the-excerpt'>
                                         $descripcion 
                                    </div>	
                                 
             </div>
                                <!-- ENDS shadow -->
                            </div>
                            <!-- ENDS project -->
              <?php echo form_close(); ?>
             
                 ";
            
          
            $return = $result.$return;
        }
        return $return;
    }
     
     

}
