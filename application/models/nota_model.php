<?php

class Nota_Model extends CI_Model {

    private $id_nota = '';
    private $titulo = '';
    private $texto = '';
    private $fecha_creacion = '';
    private $id_libreta = '';

    function __construct() {
        parent::__construct();
        $this->load->helper('date');
    }

    function registerNote($username, $titulo, $nota, $book) {


        $hoy = date("Y-m-d H:i:s");
        $data = array(
            'titulo' => $titulo,
            'texto' => $nota,
            'fecha_creacion' => $hoy,
            'id_libreta' => $book,
        );
        $insert = $this->db->insert('nota', $data);
        $insert2 = array();
        $insert2['error'] = $this->db->_error_message();
        if ($insert['error'] != '')
            return false;
        return true;
    }

    public function tamListNota($id) {
        //var_dump($query);
        $query2 = $this->db->query("select id_nota from nota where id_libreta = '$id';");
        $numrow = $query2->num_rows;


        return $numrow;
    }

    public function notaAtIndex($index, $id) {
        $nota = new Nota_Model();
        $query = $this->db->query("select id_nota,titulo,texto,fecha_creacion from nota where id_libreta = '$id';");


        $row = $query->num_rows();
        $row2 = $query->row();
        for ($i = 0; $i < $row; $i++) {



            if ($index == $i) {
                $nota->setId_nota($row2->id_nota);
                $nota->setTitulo($row2->titulo);
                $nota->setTexto($row2->texto);
            }
            $row2 = $query->next_row();
        }


        return $nota;
    }

    public function notaAtIndex2($id) {
        $nota = new Nota_Model();
        $query = $this->db->query("select id_nota,titulo,texto,fecha_creacion from nota where id_nota = '$id';");



        $row2 = $query->row();

        $nota->setTitulo($row2->titulo);
        $nota->setTexto($row2->texto);



        return $nota;
    }

    function modificarNota($username, $idNote, $tituloNota, $textoNota) {
        $data = array('titulo' => $tituloNota,
            'texto' => $textoNota,
        );

        $query = $this->db->query("UPDATE nota SET titulo = '$tituloNota',texto ='$textoNota' WHERE id_nota = '$idNote'");


        //  if($this->db->_error_message())
        //  return false;

        return true;
    }

    function BorrarNota($username, $nota2) {


        $query = $this->db->query("Delete from nota where id_nota = '$nota2'");


        if ($this->db->_error_message())
            return false;

        return true;
    }

    public function tamListNotes($id_libreta) {
        $query = $this->db->query("select n.id_nota from nota n where n.id_libreta = '$id_libreta'");
        return $query->num_rows;
    }

    public function getId_nota() {
        return $this->id_nota;
    }

    public function setId_nota($id_nota) {
        $this->id_nota = $id_nota;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function setTexto($texto) {
        $this->texto = $texto;
    }

    public function getFecha_creacion() {
        return $this->fecha_creacion;
    }

    public function setFecha_creacion($fecha_creacion) {
        $this->fecha_creacion = $fecha_creacion;
    }

    public function getId_libreta() {
        return $this->id_libreta;
    }

    public function setId_libreta($id_libreta) {
        $this->id_libreta = $id_libreta;
    }

}