<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
class nota extends CI_Controller {
    
    /**
     *  Funcion Constructor del controlador, se realizan cargas de 
     * algunos modelos y helpers usuados en el funcionamiento de 
     * el controlador 
     *  
     * @category	Controller
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('nota_model');
        $this->load->model('libreta_model');
          $this->load->model('etiqueta_model');
        $this->load->helper('form');
    }

    /**
     *  Funcion index($username) se realizan las 
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
        $data['upload'] = $this->uploadCombobox($username);
        $data['upload2'] = $this->uploadCombobox2($username);
        $data['main_content'] = '/nota/Add_Nota';
        $data['username'] = $username;
        $data['title'] = 'Create Note';
        $this->load->view('/includes/templates', $data);
    }

    /**
     * Funcion uploadCombobox($username) Esta funcion se encarga de 
     * preguntar a la capa de modelo, cuales han sido las  libretas 
     * creadas por el usuario. Para luego armar HTML que sera pasado a la 
     * vista en un combo box para agregar notas a esa libreta
     *  
     * @category	Controller
     * @param 	        string usuario que se encuentra activo 
     * @return          string se devuelven a la vista HTLM para ser Impreso
     */
    function uploadCombobox($username) {
        $return = '';
        for ($i = 0; $i < $this->libreta_model->tamListLibreta($username); $i++) {
            // se pregunta por las libretas y se extrae su informacion 
            // para ser cargada en el combo 
            $libreta = new Libreta_Model();
            $libreta = $libreta->libretaAtIndex($i, $username);

            $nombre = $libreta->getNombre();
            //$libreta->setNombre('abel');
            $id = $libreta->getId_libreta();

            $return = $return . "
            <option value= $id > $nombre </option>;";
        }
        // se retorna el string con el codigo HTML para cargae ne la vista
        return $return;
    }
    
     function uploadCombobox2($username) {
        $return = '';
        for ($i = 0; $i < $this->etiqueta_model->tamListTag($username); $i++) {
            // se pregunta por las libretas y se extrae su informacion 
            // para ser cargada en el combo 
            $etiqueta = new Etiqueta_Model();
            $etiqueta = $etiqueta->etiquetaAtIndex($i);

            $texto = $etiqueta->getTexto();
            //$libreta->setNombre('abel');
            $id = $etiqueta->getId_etiqueta();

            $return = $return . "
            <option value= $id > $texto </option>;";
        }
        // se retorna el string con el codigo HTML para cargae ne la vista
        return $return;
    }

     /**
     *  Funcion SelectNote($username, $id) se realizan las 
     * llamadas basicas para la carga de una de las vistas 
     * de creacion de libreta
     *  
     * @category	Controller
     * @param string $username usuario activo
     * @param int $id id de la nota
     */
    function SelectNote($username, $id) {

        $data = array();
        $data['messi'] = "";
       //$data['uploadNote'] = $this->uploadNoteView($username, $id);
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/nota/Modify_Note';
        $data['username'] = $username;
        $data['id'] = $id;
        $data['title'] = 'Select a Note';
        
        $this->load->library('pagination');
  
        $config['base_url'] = base_url().'/nota/SelectNote/'.$username.'/'.$id.'/';
        $config['total_rows'] = $this->nota_model->tamListNota($id);//obtenemos la cantidad de registros
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
        $notas = $this->nota_model->getnota($config['per_page'],$this->uri->segment(5),$id);
        $notastag = $this->nota_model->getnotatag($id);
        $data['records'] = $notas;
        $data['records2'] = $notastag;
        
        $this->load->view('/includes/templates', $data);
    }

     /**
     *  Funcion SelectNoteConsulta($username, $id) se realizan las 
     * llamadas basicas para la carga de una de las vistas 
     * de creacion de libreta
     *  
     * @category	Controller
     * @param string $username usuario activo
     * @param int $id id de la nota
     */
    function SelectNoteConsulta($username, $id) {

        $data = array();
        $data['messi'] = "";
        $data['uploadNote'] = $this->uploadListNotes($id);
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/nota/List_Note';
        $data['username'] = $username;
        $data['id'] = $id;
        $data['title'] = 'Select a Note';
        $this->load->view('/includes/templates', $data);
    }

    /**
     * Funcion uploadListNotes($id_libreta) Esta funcion se encarga de 
     * preguntar a la capa de modelo, cuales han sido las  notas 
     * creadas por el usuario. Para luego armar HTML que sera pasado a la 
     * vista en un div para ver la informacion notas a esa libreta
     *  
     * @category	Controller
     * @param 	        string id de la libreta que se encuentra activa 
     * @return          string se devuelven a la vista HTLM para ser Impreso
     */
    function uploadListNotes($id_libreta) {

        $return = '';
        for ($i = 0; $i < $this->nota_model->tamListNotes($id_libreta); $i++) {
            // se pregunta por las notas del usuario 
            // y se cicla armando codigo HTML para la vista
            $nota = new Nota_Model();
            $nota = $nota->notaAtIndex($i, $id_libreta);
            $titulo = $nota->gettitulo();
            $texto = $nota->gettexto();
            
            $return = $return . "<div id='page-content'>
                            <h6 class='toggle-trigger'><a href='#'> $titulo</a></h6>
                            <div class='toggle-container'>
                                <div class='block'>
                                    <p>$texto</p>
                                </div>
                            </div>

                        </div>";
        }

        return $return;
    }

    /**
     *  Funcion indexModify2($username, $id) se realizan las 
     * llamadas basicas para la carga de una de las vistas 
     * de creacion de nota
     *  
     * @category	Controller
     * @param string $username usuario activo
     * @param int $id id de la nota
     */
    function indexModify2($username, $id) {

        $data = array();
        $data['messi'] = "";
        $data['head'] = '/includes/headnormal';
        $data['upload'] = $this->uploadNoteDetail($id);
        $data['main_content'] = '/nota/Modify_Note_2';
        $data['username'] = $username;
        $data['nota'] = $id;
        $data['title'] = 'Modify Note';
        $this->load->view('/includes/templates', $data);
    }

    /**
     * Funcion uploadNoteDetail($id_note) Esta funcion se encarga de 
     * preguntar a la capa de modelo, la informacion de una nota especifica
     * Para luego armar HTML que sera pasado a la 
     * vista en un div para ver la informacion notas a esa libreta
     *  
     * @category	Controller
     * @param 	        string usuario que se encuentra activo 
     * @return          string se devuelven a la vista HTLM para ser Impreso
     */
    function uploadNoteDetail($id_note) {
        $nota = new Nota_Model();
        $nota = $nota->notaAtIndex2($id_note);

        $titulo = $nota->gettitulo();
        $texto = $nota->gettexto();
        $result = "
        
        <div>
        <label>Titulo</label>
         <input name='tittleNote'  id='tittleNote' value ='$titulo'
               type='text' class='form-poshytip' title='Enter a tittle' />
        </div>
        <div>
        <label>Note</label>
        <textarea name='Note' id='Note'  cols='30' rows='6' class='form-poshytip' title='Note'>$texto</textarea>
            </div>";

        return $result;
    }

    /**
     *  Funcion indexDelete($username, $idlibreta) se realizan las 
     * llamadas basicas para la carga de una de las vistas 
     * de creacion de nota
     *  
     * @category	Controller
     * @param string $username usuario activo
     * @param int $id id de la nota
     */
    function indexDelete($username, $idlibreta) {

        $data = array();
        $data['messi'] = "";
        $data['uploadNoteDelete'] = $this->NoteViewDelete($username, $idlibreta);
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/nota/Delete_Note';
        $data['username'] = $username;
        $data['idlibreta'] = $idlibreta;
        $data['title'] = 'Select a Note';
        
         $this->load->library('pagination');
  
        $config['base_url'] = base_url().'/nota/indexDelete/'.$username.'/'.$idlibreta.'/';
        $config['total_rows'] = $this->nota_model->tamListNota($idlibreta);//obtenemos la cantidad de registros
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
        $notas = $this->nota_model->getnota($config['per_page'],$this->uri->segment(5),$idlibreta);
        $data['records'] = $notas;
        
        
        $this->load->view('/includes/templates', $data);
    }

    /**
     * Funcion AddNote($username) funcion que se encarga 
     * de crear una nota al usuario. realizando llamada 
     * llamada al model encargadose el de dicha actividad
     * @category	Controller
     * @param           string $username usuario activo
     * @param int $libreta id de la libreta a borrar
     * 
     */
    function AddNote($username) {

        $titulo = $this->input->post('tittleNote');
        $nota = $this->input->post('Note');
        $book = $this->input->post('ListBook');
        
        $n = $this->input->post('TagN');
      
        
        if($book){
            $booleano = $this->nota_model->registerNote($username, $titulo, $nota, $book);
            
            if ($booleano == true) {
             $idNota = $this->nota_model->getMaxID();  
                for ($index = 1; $index < $n+1; $index++) {
                  $booleanito= $this->nota_model->addTags2Note($idNota,$this->input->post('Tag'.$index));
                
            
        }
        
             redirect('/homeuser/index/'.$username);
            } else
                echo "La estas cagando";
            }
         else{
             
            redirect('/nota/index/'.$username);
             
         }

        
    }

    /**
     * Funcion ModifyNote($username, $nota) funcion que se encarga 
     * de modificar una nota al usuario. realizando llamada 
     * llamada al model encargadose el de dicha actividad
     * @category	Controller
     * @param           string $username usuario activo
     * @param int $libreta id de la libreta a borrar
     * 
     */
    function ModifyNote($username, $nota) {
        $tituloNota = $this->input->post('tittleNote');
        $textoNota = $this->input->post('Note');

        $booleano = $this->nota_model->modificarNota($username, $nota, $tituloNota, $textoNota);

        if ($booleano == true) {
             redirect('/homeuser/index/'.$username);
        } else
        // caso de gente repetido
            echo "HOLA";
    }

    /**
     * Funcion DeleteNote($username, $nota2, $idlibreta2) funcion que se encarga 
     * de borarr una nota al usuario. realizando llamada 
     * llamada al model encargadose el de dicha actividad
     * @category	Controller
     * @param           string $username usuario activo
     * @param int $nota2 id de la nota a eliminar
     * @param int $libreta id de la libreta a borrar
     * 
     */
    function DeleteNote($username, $nota2, $idlibreta2) {

        // llamada al modelo para borrar un nota
        $booleano = $this->nota_model->BorrarNota($username, $nota2);

        if ($booleano == true) {
             redirect('/homeuser/index/'.$username);
        } else
        // caso de gente repetido
            echo "HOLA";
    }

    /**
     * Funcion uploadNoteView($username, $id) Esta funcion se encarga de 
     * preguntar a la capa de modelo, cuales han sido las  notas 
     * creadas por el usuario. Para luego armar HTML que sera pasado a la 
     * vista en un div para ver la informacion notas a esa nota
     *  
     * @category	Controller
     * @param 	        string username usuario activo 
     * @param 	        string id de la libreta que se encuentra activa 
     * @return          string se devuelven a la vista HTLM para ser Impreso
     */
    function uploadNoteView($username, $id) {
        $base_url = base_url() . 'images/nota.png';
        $return = '';
        for ($i = 0; $i < $this->nota_model->tamListNota($id); $i++) {


            $nota = new Nota_Model();
            $nota = $nota->notaAtIndex($i, $id);
            $idNota = $nota->getId_nota();
            $titulo = $nota->gettitulo();
            //$libreta->setNombre('abel');
            $texto = $nota->gettexto();
            $fecha_act = $nota->getFecha_creacion();
            //$descripcion= $libreta->getDescripcion();


            $attributes = array('id' => 'sc-modify-form');


            $ref = base_url() . 'Nota/indexModify2/' . $username . '/' . $idNota . '>';
            $ref2 = base_url() . 'Nota/indexModify2/' . $username . '/' . $idNota;
            $textocorto = substr($texto,0,150);
            $result = " 
            
            <?php 
               echo form_open('/Nota/indexModify2/'$username'/'$titulo','$attributes');
                ?>
                 <div class='project'>
                          <h1><a href=$ref $titulo </a></h1>
                                <!-- shadow -->
                                <div class='project-shadow'>
                                    <!-- project-thumb -->
                                    <div class='project-thumbnail'>
            

                                        <!-- meta -->
                                        <ul class='meta'>
                                            <li><strong>Project date</strong> $fecha_act </li>
                                            <li><strong>username</strong> <a href='#'> $username </a></li>
                                        </ul>
                                        <!-- ENDS meta -->

                                        <a href=$ref2 class='cover'><img src='$base_url'  alt='Feature image' /></a>
                                    </div>
                                    <!-- ENDS project-thumb -->

                                    <div class='the-excerpt'>
                                         $textocorto
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
     * Funcion NoteViewDelete($username, $id) Esta funcion se encarga de 
     * preguntar a la capa de modelo, cuales han sido las  notas 
     * creadas por el usuario. Para luego armar HTML que sera pasado a la 
     * vista en un div para ver la informacion notas a esa nota
      * para borrarla
     *  
     * @category	Controller
     * @param 	        string id de la libreta que se encuentra activa 
     * @return          string se devuelven a la vista HTLM para ser Impreso
     */
    function NoteViewDelete($username, $id) {
        $base_url = base_url() . 'images/nota.png';
        $return = '';
        for ($i = 0; $i < $this->nota_model->tamListNota($id); $i++) {


            $nota = new Nota_Model();
            $nota = $nota->notaAtIndex($i, $id);
            $idNota = $nota->getId_nota();
            $titulo = $nota->gettitulo();
            $texto = $nota->gettexto();
            $fecha_act = $nota->getFecha_creacion();



            $attributes = array('id' => 'sc-modify-form');


            $ref = base_url() . 'Nota/DeleteNote/' . $username . '/' . $idNota . '/' . $id . '>';
            $boton = base_url() . 'Nota/DeleteNote/' . $username . '/' . $idNota . '/' . $id;
            $ref2 = base_url() . 'Nota/DeleteNote/' . $username . '/' . $idNota . '/' . $id;
            $textocorto = substr($texto,0,150);
            $result = " 
            
            <?php 
               echo form_open('/Nota/DeleteNote/'$username'/'$idNota'/'$id,'$attributes');
                ?>
                 <div class='project'>
                          <h1><a href=$ref $titulo </a></h1>
                                <!-- shadow -->
                                <div class='project-shadow'>
                                    <!-- project-thumb -->
                                    <div class='project-thumbnail'>
            

                                        <!-- meta -->
                                        <ul class='meta'>
                                            <li><strong>Project date</strong> $fecha_act </li>
                                            <li><strong>username</strong> <a href='#'> $username </a></li>
                                        </ul>
                                        <!-- ENDS meta -->

                                        <a href=$ref2 class='cover'><img src='$base_url'  alt='Feature image' /></a>
                                    </div>
                                    <!-- ENDS project-thumb -->

                                    <div class='the-excerpt'>
                                         $textocorto
                                    </div>	
                 <a href=$boton class='read-more link-button' name='<?php echo $titulo ?>' id='<?php echo $titulo ?>'><span>Delete it</span></a>                                        
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
