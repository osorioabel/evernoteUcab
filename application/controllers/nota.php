<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class nota extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('nota_model');
        $this->load->model('libreta_model');
        $this->load->helper('form');
    }

    function index($username) {

        $data = array();
        $data['messi'] = "";
        $data['head'] = '/includes/headnormal';
        $data['upload'] = $this->uploadCombobox($username);
        $data['main_content'] = '/nota/Add_Nota';
        $data['username'] = $username;
        $data['title'] = 'Create Note';
        $this->load->view('/includes/templates', $data);
    }

    function uploadCombobox($username) {
        $return = '';
        for ($i = 0; $i < $this->libreta_model->tamListLibreta($username); $i++) {
            $libreta = new Libreta_Model();
            $libreta = $libreta->libretaAtIndex($i, $username);

            $nombre = $libreta->getNombre();
            //$libreta->setNombre('abel');
            $id = $libreta->getId_libreta();

            $return = $return . "
            <option value= $id > $nombre </option>;";
        }
        return $return;
    }

    function SelectNote($username, $id) {

        $data = array();
        $data['messi'] = "";
        $data['uploadNote'] = $this->uploadNoteView($username, $id);
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/nota/Modify_Note';
        $data['username'] = $username;
        $data['id'] = $id;
        $data['title'] = 'Select a Note';
        $this->load->view('/includes/templates', $data);
    }

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

    function uploadListNotes($id_libreta) {

        $return = '';
        for ($i = 0; $i < $this->nota_model->tamListNotes($id_libreta); $i++) {
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

    function uploadNoteDetail($id_note) {
        $nota = new Nota_Model();
        $nota = $nota->notaAtIndex2($id_note);

        $titulo = $nota->gettitulo();
        $texto = $nota->gettexto();
        $result = "
        
        <div>
                        <label>Titulo</label>
                         <input name='tituloNota'  id='titulo' value ='$titulo'
                               type='text' class='form-poshytip' title='Enter a tittle' />
                    </div>
                    <div>
                        <label>Note</label>
                        <textarea name='texto' id='texto'  cols='30' rows='6' class='form-poshytip' title='Note'>'$texto'</textarea>
                    </div>";

        return $result;
    }

    function indexDelete($username, $idlibreta) {

        $data = array();
        $data['messi'] = "";
        $data['uploadNoteDelete'] = $this->NoteViewDelete($username, $idlibreta);
        $data['head'] = '/includes/headnormal';
        $data['main_content'] = '/nota/Delete_Note';
        $data['username'] = $username;
        $data['idlibreta'] = $idlibreta;
        $data['title'] = 'Select a Note';
        $this->load->view('/includes/templates', $data);
    }

    function AddNote($username) {

        $titulo = $this->input->post('tittleNote');
        $nota = $this->input->post('Note');
        $book = $this->input->post('ListBook');


        $booleano = $this->nota_model->registerNote($username, $titulo, $nota, $book);
        if ($booleano == true) {
            $this->index($username);
        } else
            echo "La estas cagando";
    }

    function ModifyNote($username, $nota) {
        $tituloNota = $this->input->post('tituloNota');
        $textoNota = $this->input->post('texto');

        $booleano = $this->nota_model->modificarNota($username, $nota, $tituloNota, $textoNota);

        if ($booleano == true) {
            $this->indexModify2($username, $nota, '');
        } else
        // caso de gente repetido
            echo "HOLA";
    }

    function DeleteNote($username, $nota2, $idlibreta2) {



        $booleano = $this->nota_model->BorrarNota($username, $nota2);

        if ($booleano == true) {
            $this->indexDelete($username, $idlibreta2, '');
        } else
        // caso de gente repetido
            echo "HOLA";
    }

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
                                         $texto
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
                                         $texto
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
