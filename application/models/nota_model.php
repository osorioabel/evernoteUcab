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


   function registerNote($username,$titulo,$nota,$book) {
  
      
        $hoy = date("Y-m-d H:i:s");   
        $data = array(
            'titulo' =>  $titulo,
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
        $numrow= $query2->num_rows;
              

        return $numrow ;
    }
    
    
     public function notaAtIndex($index,$id) {
        $nota = new Nota_Model();
        $query = $this->db->query("select id_nota,titulo,texto,fecha_creacion from nota where id_libreta = '$id';");
            
            
            $row = $query->num_rows();
             $row2 = $query->row();
            for($i=0; $i<$row; $i++){
            
                
            
               if($index==$i){
               $nota->setId_nota($row2->id_nota);
               $nota->settitulo($row2->titulo);
               $nota->settexto($row2->texto);
               $nota->setFecha_creacion($row2->fecha_creacion);
               }
             $row2=$query->next_row();  
            }
        

        return $nota;
    }
    
    
      function modificarNota($username,$idNote,$tituloNota,$textoNota) {
        $data = array('titulo' => $tituloNota,
            'texto' => $textoNota,
        );

        $query = $this->db->query("UPDATE nota SET titulo = '$tituloNota',texto ='$textoNota' WHERE id_nota = '$idNote'");


        //  if($this->db->_error_message())
        //  return false;

        return true;
    }

    
     public function getId_nota() {
        return $this->id_nota;
    }

    public function setId_nota($id_nota) {
        $this->id_nota = $id_nota;
    }

    public function gettitulo() {
        return $this->titulo;
    }

    public function settitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function gettexto() {
        return $this->texto;
    }

    public function settexto($texto) {
        $this->texto = $texto;
    }

    public function getFecha_creacion() {
        return $this->fecha_creacion;
    }

    public function setFecha_creacion($fecha_creacion) {
        $this->fecha_creacion = $fecha_creacion;
    }

    public function getid_libreta() {
        return $this->id_libreta;
    }

    public function setid_libreta($id_libreta) {
        $this->id_libreta = $id_libreta;
    }

    
    
    
    }