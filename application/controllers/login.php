<?php



class Login extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        
    }
    
     function index() {
          
         $data = array();
         $data['main_content']='login';
         $data['title']='Login Page';
         $this->load->view('/includes/templates', $data);
        
    }
    
    
    function validatelogin() {
        $this->form_validation->set_rules('username', 'Username', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Username', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
                $this->index();
        }
        else
        {
                $this->load->view('formsuccess');
        }
    }
    
    
}
?>
