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
class libreta extends CI_Controller {

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
        $this->load->helper('form');
        $this->load->library('pagination');
        $this->load->library('table');
   
    }

    /**
     *  Funcion index() se realizan las 
     * llamadas basicas para la carga de una de las vistas 
     * de creacion de libreta
     *  
     * @category	Controller
     * @param string $username usuario activo
     */
    function index($username) {

        $data = array();
        $data['messi'] = "";
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/libreria/libreria';
        $data['username'] = $username;
        $data['title'] = 'Create Book';
        $this->load->view('/includes/templates', $data);
    }

    /**
     *  Funcion indexModify($username) se realizan las 
     * llamadas basicas para la carga de una de las vistas 
     * de modificacion de la informacion de la libreta
     *  
     * @category	Controller
     * @param string $username usuario 
     */
    function indexModify($username) {

        $data = array();
        $data['messi'] = "";
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/libreria/Libreta_Modificar';
        $data['username'] = $username;
        // aca se llama a funcion para cargar las libretas del usuario
        // esta variable trae un codigo HTML para que se realice 
        // su visualizacion en la interfaz de Modificar 
        $data['title'] = 'Modify Book';
        $this->load->library('pagination');
        $this->load->library('table');
        
         $config['base_url'] = base_url().'/libreta/indexModify/'.$username.'/';
        $config['total_rows'] = $this->libreta_model->getCantidad();//obtenemos la cantidad de registros
        $config['per_page'] = 6;
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
        $libretas = $this->libreta_model->getlibreta($config['per_page'],$this->uri->segment(4));
        $data['records'] = $libretas;
        //$data['upload'] = $this->uploadNotebookViewModify($username);
        $this->load->view('/includes/templates', $data);
    }

    /**
     * Funcion indexModify2($username, $id) se realizan las 
     * llamadas basicas para cargar la vista de modificacion
     * de libreta, una vez que ya se ha seleccionado cual se
     * desea modificar 
     * @category	Controller
     * @param           string $username usuario activo
     * @param           int $id id de la libreta a modificar
     */
    function indexModify2($username, $id) {

        $data = array();
        $data['messi'] = "";
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/libreria/Libreta_Modificar_2';
        // aca se llama a funcion para cargar las libretas del usuario
        // esta variable trae un codigo HTML para que se realice 
        // su visualizacion en la vista de los detalles de la libreta a 
        //modificar 
        $data['upload'] = $this->uploadBookDetail($username, $id);
        $data['username'] = $username;
        $data['libreta'] = $id;
        $data['title'] = 'Modify Book';
        $data['records'] = $this->db->get('libreta',10,$this->uri->segment(3));
        $this->load->view('/includes/templates', $data);
    }

    /**
     * Funcion uploadBookDetail($username, $id_libreta) Esta funcion se encarga
     *  de preguntar a la capa de modelo, cuales son los datos de la libreta 
     * seleccionada. Para luego armar HTML que sera pasado a la 
     * vista..
     *  
     * @category	Controller
     * @param 	        string usuario que se encuentra activo 
     * @param int $id_libreta id de la libreta a ver su detalle 
     * @return string codigo HTML para ser cargado en la vista
     */
    function uploadBookDetail($username, $id_libreta) {
        $return = '';
        $libreta = new Libreta_Model();
        // se llama al modelo y se trae la informacion de la libreta
        //que ya hemos seleccionado para cambiar
        $libreta = $libreta->libretaAtIndex2($id_libreta, $username);
        $nombre = $libreta->getNombre();
        $descripcion = $libreta->getDescripcion();
        // se empeiza a armar etiquetas HTML para su posterior carga en la 
        // vista 
        $return = "<div>
                  <label>Title</label>
           <input name='tituloBook'  id='tituloBook' value ='$nombre'
        type='text' class='form-poshytip' title='Enter a tittle' />
        </div>
        <div>
        <label>Description</label>
        <textarea name='descrip' id='descrip'  cols='30' rows='6'
        class='form-poshytip' title='Description'>$descripcion</textarea>
        </div>";
        return $return;
    }

    /**
     * Funcion indexDelete($username) se realizan las 
     * llamadas basicas para cargar la vista de borrar
     * de libreta, una vez que ya se ha seleccionado cual se
     * desea borrar 
     * @category	Controller
     * @param           string $username usuario activo
     * 
     */
    function indexDelete($username) {

        $data = array();
        $data['messi'] = "";
        // se llama al modelo y se trae la informacion de la libreta
        //que ya hemos seleccionado para borrar
       // $data['upload'] = $this->uploadNotebookViewDelete($username);
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/libreria/Libreta_Eliminar';
        $data['username'] = $username;
        $data['title'] = 'Delete Book';
        
        $this->load->library('pagination');
   
        
         $config['base_url'] = base_url().'/libreta/indexDelete/'.$username.'/';
        $config['total_rows'] = $this->libreta_model->getCantidad();//obtenemos la cantidad de registros
        $config['per_page'] = 6;
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
        $libretas = $this->libreta_model->getlibreta($config['per_page'],$this->uri->segment(4));
        $data['records'] = $libretas;
        
        
        $this->load->view('/includes/templates', $data);
    }

     /**
     * Funcion indexSelect($username) se realizan las 
     * llamadas basicas para cargar la vista de seleccionar
     * de libreta, una vez que ya se ha seleccionado cual se
     * desea seleccionado 
     * @category	Controller
     * @param           string $username usuario activo
     * 
     */
    function indexSelect($username) {

        $data = array();
        $data['messi'] = "";
        // se llama al modelo y se trae la informacion de la libreta
        //que ya hemos seleccionado para ver su informacion
        $data['upload'] = $this->uploadNotebookView($username);
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/libreria/Libreta_Select';
        $data['username'] = $username;
        $data['title'] = 'Your Books';
        $this->load->library('pagination');
        $config['base_url'] = base_url().'/libreta/indexSelect/'.$username.'/';
        $config['total_rows'] = $this->libreta_model->getCantidad();//obtenemos la cantidad de registros
        $config['per_page'] = 6;
        $config['num_links'] = 10;
        
        
        
        $config['prev_link'] = 'anterior'; //texto del enlace que nos lleva a la pagina ant.
        $config['next_link'] ='siguiente'; //texto del enlace que nos lleva a la sig. página
        $config['uri_segment'] = '4';  //segmentos que va a tener nuestra URL
        $config['first_link'] = '<<';  //texto del enlace que nos lleva a la primer página
        $config['last_link'] = '>>';   //texto del enlace que nos lleva a la última página
        //$config['num_tag_open'] = '<ul class="pager">';
        //$config['num_tag_close'] = '</ul>';
        $this->pagination->initialize($config);
        
       // $data["records"] = $this->db->get('libreta',$config['per_page'],$this->uri->segment(3));
        $libretas = $this->libreta_model->getlibreta($config['per_page'],$this->uri->segment(4));
        $data['records'] = $libretas;
        $this->load->view('/includes/templates', $data);
    }

    /**
     * Funcion indexSelectConsulta($username) se realizan las 
     * llamadas basicas para cargar la vista de seleccionar
     * de libreta, una vez que ya se ha seleccionado cual se
     * desea seleccionado, en este caso  
     * @category	Controller
     * @param           string $username usuario activo
     * 
     */
    function indexSelectConsulta($username) {
       
        $data = array();
        $data['messi'] = "";
        // se llama al modelo y se trae la informacion de la libreta
        //que ya hemos seleccionado para ver su informacion
      //  $data['upload3'] = $this->uploadNotebookView2($username);
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/libreria/Select_Libreta_Consulta';
        $data['username'] = $username;
        //$data['libreta'] = $id;
        $data['title'] = 'Your Books';
        
        $this->load->library('pagination');
        $config['base_url'] = base_url().'/libreta/indexSelectConsulta/'.$username.'/';
        $config['total_rows'] = $this->libreta_model->getCantidad();//obtenemos la cantidad de registros
        $config['per_page'] = 6;
        $config['num_links'] = 10;
        
        
        
        $config['prev_link'] = 'anterior'; //texto del enlace que nos lleva a la pagina ant.
        $config['next_link'] ='siguiente'; //texto del enlace que nos lleva a la sig. página
        $config['uri_segment'] = '4';  //segmentos que va a tener nuestra URL
        $config['first_link'] = '<<';  //texto del enlace que nos lleva a la primer página
        $config['last_link'] = '>>';   //texto del enlace que nos lleva a la última página
        //$config['num_tag_open'] = '<ul class="pager">';
        //$config['num_tag_close'] = '</ul>';
        $this->pagination->initialize($config);
        
       // $data["records"] = $this->db->get('libreta',$config['per_page'],$this->uri->segment(3));
        $libretas = $this->libreta_model->getlibreta($config['per_page'],$this->uri->segment(4));
        $data['records'] = $libretas;
        
        
        
        
        
        $this->load->view('/includes/templates', $data);
    }

    /**
     * Funcion indexDeleteNote($username) se realizan las 
     * llamadas basicas para cargar la vista de modificacion
     * de libreta, una vez que ya se ha seleccionado cual se
     * desea seleccionado, en este caso para borrar
     * @category	Controller
     * @param           string $username usuario activo
     * 
     */
    function indexDeleteNote($username) {

        $data = array();
        $data['messi'] = "";
        $data['upload4'] = $this->uploadNotebookView3Delete($username);
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/libreria/Libreta_delete_note';
        $data['username'] = $username;
        //$data['libreta'] = $id;
        $data['title'] = 'Your Books';
        $this->load->library('pagination');
        $config['base_url'] = base_url().'/libreta/indexDeleteNote/'.$username.'/';
        $config['total_rows'] = $this->libreta_model->getCantidad();//obtenemos la cantidad de registros
        $config['per_page'] = 6;
        $config['num_links'] = 10;
        
        
        
        $config['prev_link'] = 'anterior'; //texto del enlace que nos lleva a la pagina ant.
        $config['next_link'] ='siguiente'; //texto del enlace que nos lleva a la sig. página
        $config['uri_segment'] = '4';  //segmentos que va a tener nuestra URL
        $config['first_link'] = '<<';  //texto del enlace que nos lleva a la primer página
        $config['last_link'] = '>>';   //texto del enlace que nos lleva a la última página
        //$config['num_tag_open'] = '<ul class="pager">';
        //$config['num_tag_close'] = '</ul>';
        $this->pagination->initialize($config);
        
       // $data["records"] = $this->db->get('libreta',$config['per_page'],$this->uri->segment(3));
        $libretas = $this->libreta_model->getlibreta($config['per_page'],$this->uri->segment(4));
        $data['records'] = $libretas;
        
        
        $this->load->view('/includes/templates', $data);
    }
    

     /**
     * Funcion AddBook($username) funcion que se encarga 
     * de crear una libreta al usuario. realizando llamada 
     * llamada al model encargadose el de dicha actividad
     * @category	Controller
     * @param           string $username usuario activo
     * 
     */
    function AddBook($username) {
        $titulo = $this->input->post('tituloBook');
        $descripcion = $this->input->post('descrip');
        // llamada al modelo y la creacion de la libreta
        $booleano = $this->libreta_model->registerBook($username, $titulo, 
                                                       $descripcion);
        if ($booleano == true) {
            // si se pudo crear la libreta
            //redirecciona al home del usuario
            redirect('/homeuser/indexafter/' . $username);
        } else
            echo "";
    }

    /**
     * Funcion ModifyBook($username, $libreta)) funcion que se encarga 
     * de modificar una libreta al usuario. realizando llamada 
     * llamada al model encargadose el de dicha actividad
     * @category	Controller
     * @param           string $username usuario activo
     * @param int $libreta id de la libreta a modificar
     * 
     */
    function ModifyBook($username, $libreta) {
        // se reciben los post de la vista
        $tituloLibreta = $this->input->post('tituloBook');
        $descripLibreta = $this->input->post('descrip');
        
        // llamada al modelo y la modificacion de la libreta
        $booleano = $this->libreta_model->modificarLibreta($username, $libreta,
                                                $tituloLibreta, $descripLibreta);
        if ($booleano == true) {
            // si se pudo realizar el cambio redireccionar al home del usuario
             redirect('/homeuser/indexafter/' . $username);
        } else
        // caso de gente repetido
            echo "";
    }
    
    /**
     * Funcion DeleteBook($username, $libreta) funcion que se encarga 
     * de borarr una libreta al usuario. realizando llamada 
     * llamada al model encargadose el de dicha actividad
     * @category	Controller
     * @param           string $username usuario activo
     * @param int $libreta id de la libreta a borrar
     * 
     */
    function DeleteBook($username, $libreta) {
        // llamada al modelo para eliminar la libreta
        $booleano = $this->libreta_model->BorrarLibreta($username, $libreta);
        if ($booleano == true) {
            // si se pudo realizar la eliminacion redirecciona al home del user
             redirect('/homeuser/indexafterdelete/' . $username);
        } else
            echo "";
    }

    /**
     * Funcion uploadLastBooks($username) Esta funcion se encarga de 
     * preguntar a la capa de modelo, cuales han sido las ultimas 3 libretas 
     * creadas por el usuario. Para luego armar HTML que sera pasado a la 
     * vista al momento del login exitoso del usuario.
     *  
     * @category	Controller
     * @param 	        string usuario que se encuentra activo 
     * @return          string se devuelven a la vista HTLM para ser Impreso
     */
    function uploadNotebookViewDelete($username) {
        $base_url = base_url() . 'images/book.png';
        $return = '';
        for ($i = 0; $i < $this->libreta_model->tamListLibreta($username); $i++) {
            // este for se realiza por tantas veces el usuario tenga libretas 
            $libreta = new Libreta_Model();
            $libreta = $libreta->libretaAtIndex($i, $username); // se busca la libreta por su ID
            $nombre = $libreta->getNombre();
            $id = $libreta->getId_libreta();
            $fecha = $libreta->getFecha();
            $descripcion = $libreta->getDescripcion(); // se realiza la lectura de atributos 
            // se empieza a armar HTML que sera usado en la vista 
            // luego de consultar en la capa de modelo
            $attributes = array('id' => 'sc-contact-form');
            $ref = base_url() . 'Libreta/indexDelete/' . $username . '>';
            $boton = base_url() . 'Libreta/DeleteBook/' . $username . '/' . $id;
            $ref2 = base_url() . 'Libreta/indexDelete/' . $username;
            $result = "
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
            $return = $result . $return; // aca se concatena el HTML requerido para pintar  
            // cada libreta notebook a eliminar 
        }
        return $return;
    }

     /**
     * Funcion uploadNotebookView($username) Esta funcion se encarga de 
     * preguntar a la capa de modelo, cuales han sido las que libretas han sido
     * creadas por el usuario. Para luego armar HTML que sera pasado a la 
     * para usarse al momento de q el usuario quiera ver todas sus libretas.
     *  
     * @category	Controller
     * @param 	        string usuario que se encuentra activo 
     * @return          string se devuelven a la vista HTLM para ser Impreso
     */
    function uploadNotebookView($username) {
        $base_url = base_url() . 'images/book.png';
        $return = '';
       
        $i=2;
        $this->load->library('pagination');
        $this->load->library('table');
   
      
        //$libretas = $this->libreta_model->getlibreta($config['per_page'],$this->uri->segment(3));
      //  for ($i = 0; $i < $this->libreta_model->tamListLibreta($username); $i++) {

        
        
      $libreta = new Libreta_Model();
            // se hace un simple get de la libreta en posicion del 
            // del usuario 
            //$libreta = $libreta->libretaAtIndex($i, $username);  
    
            $nombre = $libreta->getNombre();
            $id = $libreta->getId_libreta();
            $fecha = $libreta->getFecha();
            $descripcion = $libreta->getDescripcion();
            $attributes = array('id' => 'sc-contact-form');
            $ref = base_url() . 'Nota/SelectNote/' . $username . '/' . $id . '>';
            $ref2 = base_url() . 'Libreta/indexSelect/' . $username . '/' . $nombre;
            
            $result = "   
           
       
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
       
         $return = $result . $return; 
            // se concatenan las
          
         
        //}
        return $return;
    }

    /**
     * Funcion uploadNotebookViewModify Esta funcion se encarga de 
     * preguntar a la capa de modelo, por una libreta han sido
     * creadas por el usuario. Para luego armar HTML que sera pasado a la 
     * para usarse al momento de q el usuario quiera modificarla
     *  
     * @category	Controller
     * @param 	        string usuario que se encuentra activo 
     * @return          string se devuelven a la vista HTLM para ser Impreso
     */
    function uploadNotebookViewModify($username) {
        $base_url = base_url() . 'images/book.png';
        $return = '';
        for ($i = 0; $i < $this->libreta_model->tamListLibreta($username); $i++) {
            // se pregunta por la cantidad de llibretas del usuario
            
            $libreta = new Libreta_Model();
            $libreta = $libreta->libretaAtIndex($i, $username);
            // se trae la libreta en cierta posicion y se extraen atriburtos
            $id = $libreta->getId_libreta();
            $nombre = $libreta->getNombre();
            $fecha = $libreta->getFecha();
            $descripcion = $libreta->getDescripcion();
             
           
            //$this->load->view("miVista",$data);
            // se comienza a crear HTLM para mostrar en la vista
            $attributes = array('id' => 'sc-contact-form');
            $ref = base_url() . 'Libreta/indexModify2/' . $username . '/' . $id . '>';
            $ref2 = base_url() . 'Libreta/indexModify2/' . $username . '/' . $id;

            $result = " 
            
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
           
            $return = $result . $return;
            
        }
        
        return $return;
    }

    /**
     * Funcion uploadNotebookView2($username) Esta funcion se encarga de 
     * preguntar a la capa de modelo, por una libreta han sido
     * creadas por el usuario. Para luego armar HTML que sera pasado a la 
     * para usarse al momento de q el usuario quiera modificarla
     *  
     * @category	Controller
     * @param 	        string usuario que se encuentra activo 
     * @return          string se devuelven a la vista HTLM para ser Impreso
     */
    function uploadNotebookView2($username) {
        $base_url = base_url() . 'images/book.png';
        $return = '';
        for ($i = 0; $i < $this->libreta_model->tamListLibreta($username); $i++) {


            $libreta = new Libreta_Model();
            $libreta = $libreta->libretaAtIndex($i, $username);

            $nombre = $libreta->getNombre();
            //$libreta->setNombre('abel');
            $id = $libreta->getId_libreta();
            $fecha = $libreta->getFecha();
            $descripcion = $libreta->getDescripcion();


            $attributes = array('id' => 'sc-modify-form');


            $ref = base_url() . 'nota/SelectNoteConsulta/' . $username . '/' . $id . '>';
            $ref2 = base_url() . 'Libreta/indexSelect/' . $username . '/' . $nombre;

            $result = " 

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


$return = $result . $return;
        }
        return $return;
    }

    /**
     * Funcion uploadNotebookView3Delete($username) Esta funcion se encarga de 
     * preguntar a la capa de modelo, por una libreta han sido
     * creadas por el usuario. Para luego armar HTML que sera pasado a la 
     * para usarse al momento de q el usuario quiera borrarla
     *  
     * @category	Controller
     * @param 	        string usuario que se encuentra activo 
     * @return          string se devuelven a la vista HTLM para ser Impreso
     */
    function uploadNotebookView3Delete($username)  {
        $base_url = base_url() . 'images/book.png';
        $return = '';
        for ($i = 0; $i < $this->libreta_model->tamListLibreta($username); $i++) {
            // se pregunta por la cantidad de libretas de un usuario

            $libreta = new Libreta_Model();
            $libreta = $libreta->libretaAtIndex($i, $username);

            $nombre = $libreta->getNombre();
    
            $id = $libreta->getId_libreta();
            $fecha = $libreta->getFecha();
            $descripcion = $libreta->getDescripcion();


            $attributes = array('id' => 'sc-modify-form');


            $ref = base_url() . 'nota/indexDelete/' . $username . '/' . $id . '>';
            $ref2 = base_url() . 'Libreta/indexSelect/' . $username . '/' . $nombre;

            $result = " 
            
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


            $return = $result . $return;
        }
        return $return;
    }

}
