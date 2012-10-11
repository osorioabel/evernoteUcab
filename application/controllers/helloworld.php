<?php



class helloworld extends CI_Controller{
    
    
    
    public function index() {
        
        $data = array();
        $data['main_content'] = 'contenido1';
        //echo $data['main_content'];
        $data['title'] = 'Blog->Abel Osorio';
        $this->load->view('/includes/templates', $data);
        
        
    }
    
    
    
    
}
?>
