
<?php
require_once (APPPATH.'/models/usuario_model.php');
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mock_Model extends Usuario_Model {
    
    public function login($username, $password) {
    $username_value ="osorioabel";
    $password_value="490263";
    
    if(($username==$username_value)&&($password==$password_value))
    {
        return true;
    }
    return false;
    
    }
    
}

?>
