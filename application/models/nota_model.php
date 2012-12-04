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

class Nota_Model extends CI_Model {

    private $id_nota = '';
    private $titulo = '';
    private $texto = '';
    private $fecha_creacion = '';
    private $id_libreta = '';

    function __construct() {
        parent::__construct();
        $this->load->helper('date');
         $this->load->model('etiqueta_model');
    }

    /**
    * 
    *
    * Esta Funcion registerNote($username, $titulo, $nota, $book) 
    * se encarga de registrar una nota en la base de datos 
    * a un usuario
    *@category Modelo
    * @param	string	nombre del usuario
    * @param	string	titulo de la nota
    * @param	string	cuerpo de la nota
    * @param	string	libreta para asociar la nota
    * @return	boolean dice si actualizo o no 
    */
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

    
     /**
    * Esta Funcion tamListNota($id) 
    * se encarga de contar cuantas notas tiene un usuario en una libreta 
    * 
    *@category Modelo
    * @param	string	id de la libreta
    * @return	int dice cantidad de notas
    */
    public function tamListNota($id) {
        //var_dump($query);
        $query2 = $this->db->query("select id_nota from nota where id_libreta = '$id';");
        $numrow = $query2->num_rows;
        return $numrow;
    }

    /**
    * Esta Funcion notaAtIndex($index, $id)
    * se encarga de contar devolver una nota que
    *  tiene un usuario en una libreta 
    * 
    *@category Modelo
    * @param	string	posicion de la nota en la lista
    * @param	string	id de la libreta
    * @return	int dice cantidad de notas
    */
    public function notaAtIndex($index, $id) {
        $nota = new Nota_Model();
        $query = $this->db->query("select id_nota,titulo,texto,fecha_creacion 
        from nota where id_libreta = '$id';");
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
    
    public function getMaxID(){
        $query= $this->db->query("select max(id_nota)  from nota ");
        $row2 = $query->row();
        return $row2->id_nota;       
     }

    /**
    * Esta Funcion notaAtIndex2($id)
    * se encarga de devolver una nota que
    *  tiene un usuario en la base de datos 
    * 
    *@category Modelo
    * @param	string	nombre del usuario
    * @return	int dice cantidad de notas
    */
    public function notaAtIndex2($id) {
        $nota = new Nota_Model();
        $query = $this->db->query("select id_nota,titulo,texto,fecha_creacion from nota where id_nota = '$id';");
        $row2 = $query->row();
        $nota->setTitulo($row2->titulo);
        $nota->setTexto($row2->texto);

        return $nota;
    }
    
    public function addTags2Note($id,$tag){
        
        
    }

    /**
    * 
    *
    * Esta Funcion modificarNota($username, $idNote, $tituloNota, $textoNota) 
    * se encarga de modificar un nota en la base de datos 
    * a un usuario
    *@category Modelo
    * @param	string	nombre del usuario
    * @param	string	id de la nota a modificar
    * @param	string	titulo de la nota
    * @param	string	contenido de la nota
    * @return	boolean dice si actualizo o no 
    */
    function modificarNota($username, $idNote, $tituloNota, $textoNota) {
        $data = array('titulo' => $tituloNota,
            'texto' => $textoNota,
        );

        $query = $this->db->query("UPDATE nota SET titulo = '$tituloNota',texto ='$textoNota' WHERE id_nota = '$idNote'");
        return true;
    }

    /**
    * 
    *
    * Esta Funcion BorrarNota($username, $nota2)
    * se encarga de borrar un nota en la base de datos 
    * a un usuario
    *@category Modelo
    * @param	string	nombre del usuario
    * @param	string	id de la nota
    * @return	boolean dice si actualizo o no 
    */
    function BorrarNota($username, $nota2) {


        $query = $this->db->query("Delete from nota where id_nota = '$nota2'");


        if ($this->db->_error_message())
            return false;

        return true;
    }

     /**
    * Esta Funcion tamListNota($id) 
    * se encarga de contar cuantas notas tiene un usuario en una libreta 
    * 
    *@category Modelo
    * @param	string	id de la libreta
    * @return	int dice cantidad de notas
    */
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