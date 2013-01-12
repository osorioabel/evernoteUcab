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
        if ($insert['error'] != ''){
              log_message("error", "Error   registing a Note  in a NoteBook .. ");  
            return false;
        }
             log_message("error", "Succesfull registing a Note  in a NoteBook .. ");  
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
    * Esta Funcion tamListNotaBuscar($objetivo) 
    * se encarga de contar cuantas notas se estan buscando
    * 
    *@category Modelo
    * @param	string $objetivo contenido buscado en la nota
    * @return	devuelve cuantas notas hay
    */
    public function tamListNotaBuscar($objetivo) {
      $query2 = $this->db->query("(select n.id_nota, n.titulo,n.texto from nota n where n.texto like '%$objetivo%' or n.titulo like '%$objetivo%') union (select n.id_nota,n.titulo,n.texto from nota n,nota_etiqueta ne,etiqueta e  where e.texto like '%$objetivo%' and ne.fk_etiqueta = e.id_etiqueta and ne.fk_nota=n.id_nota);");
    /*   
   $this->db->select('nota.id_nota,nota.titulo,nota.texto,nota.fecha_creacion');
   $this->db->from('nota');
   $this->db->like('nota.titulo', $objetivo);
  $this->db->or_like('nota.texto', $objetivo);
   //$this->db->join('libreta','nota.id_libreta = libreta.id_libreta');
   //$this->db->join('usuario','libreta.fk_usuario=usuario.id_usuario');
   //$this->db->where('usuario.id_usuario',$username);
   $query = $this->db->get();   
   $subQuery1 = $this->db->last_query();
  
  // $this->db->_reset_select();
   
   
   $this->db->select('nota.id_nota,nota.titulo,nota.texto,nota.fecha_creacion');
   $this->db->from('nota');
   $this->db->join('nota_etiqueta', 'nota.id_nota = nota_etiqueta.fk_nota');
   $this->db->join('etiqueta', 'etiqueta.id_etiqueta = nota_etiqueta.fk_etiqueta');        
   $this->db->like('etiqueta.texto', $objetivo);   
   $query = $this->db->get();
   $subQuery2 = $this->db->last_query();  
   //$this->db->_reset_select();
   
   $query = $this->db->query("select * from ($subQuery1 UNION $subQuery2) as unionTable");
     * 
     * 
     */     
   $numrow = $query2->num_rows;
   return $numrow;
    }
    
    
    
     /**
    * Esta Funcion getBuscarNotas($numeroRegistros,$inicio,$objetivo) 
    * se encarga de contar cuantas notas se estan buscando
    * 
    *@category Modelo
    * @param	string $numeroRegistros
    * @param	string $inicio
    * @param	string $objetivo
    * @return	devuelve las notas de la busqueda
    */
   function getBuscarNotas($numeroRegistros,$inicio,$objetivo,$username)

{

    $this->db->limit($numeroRegistros);
   
   $query = $this->db->query("select * from (select Distinct n.id_nota,n.titulo,n.texto,n.fecha_creacion,n.id_libreta from nota n,libreta l, usuario u where u.id_usuario = l.fk_usuario and n.id_libreta = l.id_libreta and u.username = '$username') as n where n.titulo like '%$objetivo%' or n.texto like '%$objetivo%'");
    
    return $query->result();
    
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
    
   /**
    * getMaxID
    * se encarga de devlver el id mayor de las notas
    * 
    *@category Modelo
    * @return	devuelve el maximo id de las notas
    */
    public function getMaxID(){
        $query= $this->db->query("select id_nota from nota order by 1 desc");
        $row2 = $query->row();
        return $row2->id_nota;       
     }
    
 /**
    * Esta Funcion getnota($numeroRegistros, $inicio,$id)
    * se encarga de obtener la nota
    * 
    *@category Modelo
    * @param	string $numeroRegistros
    * @param	string $inicio
    * @param	string $id
    * @return	devuelve las nota buscada
    */     
function getnota($numeroRegistros, $inicio,$id)

{

    $this->db->limit($numeroRegistros, $inicio);

    $this->db->select('id_nota,titulo,texto,fecha_creacion');
    $this->db->where('id_libreta', $id);
    $query = $this->db->get('nota');
//$query = $this->db->query("select id_nota,titulo,texto,fecha_creacion from nota where id_nota = '$id';");
return $query->result();



}

/**
    * Esta Funcion getnotatag($busqueda)
    * se encarga de buscar lostags de una nota
    * 
    *@category Modelo
    * @param	string $busqueda id de la libreta
    * @return	devuelve las notas de la libreta
    */ 
    function getnotatag($busqueda)

{

    $this->db->limit(4,1);
    $query = $this->db->query("select n.titulo,e.texto from nota n,nota_etiqueta ne,etiqueta e where n.id_libreta = $busqueda and n.id_nota = ne.fk_nota and ne.fk_etiqueta = e.id_etiqueta;");
    return $query->result();
    
    }
    
      function getnotaadjunto($busqueda)

{

    $this->db->limit(4,1);
    $query = $this->db->query("select n.titulo,a.link from nota n,nota_adjunto na,adjunto a where n.id_libreta = $busqueda and n.id_nota = na.fk_nota and na.fk_adjunto = a.id_adjunto;");
    return $query->result();
    
    }
    
    
    
    /**
    * Esta Funcion gettingnotatags($id_nota)
    * se encarga de buscar lostags de una nota
    * 
    *@category Modelo
    * @param	string $id_nota id de la libreta
    * @return	devuelve las notas de la libreta
    */ 
     function gettingnotatags($id_nota)

{

    //$this->db->limit(4,1);
    $query = $this->db->query("select n.titulo,e.texto from nota n,nota_etiqueta ne,etiqueta e where n.id_nota = '$id_nota' and n.id_nota = ne.fk_nota and ne.fk_etiqueta = e.id_etiqueta;");
    return $query->result();
    
    }   

   /**
    * Esta Funcion getBuscarNotasSelected($numeroRegistros, $inicio,$idNota)
    * se encarga de buscar lostags de una nota
    * 
    *@category Modelo
    * @param	string $numeroRegistros
    * @param	string $inicio
    * @param             string $idNota
    * @return	devuelve la nota
    */  
function getBuscarNotasSelected($numeroRegistros, $inicio,$idNota)

{

     $this->db->limit($numeroRegistros, $inicio);

    $this->db->select('id_nota,titulo,texto,fecha_creacion');
    $this->db->where('id_nota', $idNota);
   
    $query = $this->db->get('nota');

return $query->result();



}

 /**
    * Esta Funcion getCantidad ()
    * se encarga de contar  cuantas notas hay
    * @return	devuelve la cantidad de notas
    */  
function getCantidad ()

{

return $this->db->count_all('nota');

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
    
    
    /**
    * Esta Funcion addTags2Note($id,$tag)
    * se encarga de agregar tags a una nota
    *  en especifico
    * 
    *@category Modelo
    * @param	string	$id id de la nota
     * @param	string	$tag contenido del tag
    * @return	int dice cantidad de notas
    */
    public function addTags2Note($id,$tag){

        $etiqueta = new Etiqueta_Model();
        $idTag = $this->etiqueta_model->createTag($tag);
        $data = array(
            'fk_nota' => $id,
            'fk_etiqueta'=>$idTag,
        );
         $query = $this->db->insert('nota_etiqueta', $data);
         
         return true;

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
    
      public function deletenota() {
        $user = new Usuario_Model();
        $query = $this->db->query("delete from nota where titulo='Nota de Prueba'");
        if ($this->db->_error_message())
            return false;

        return true;
    }

}