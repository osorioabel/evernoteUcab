<div class="container_12">     
  <div class="grid_12" id="login">
        Login de la Pagina web
        <?php
        
        $attributes = array(
            
            'name' => 'login_form',
            'id' => 'login_form',
            'class' => 'form_login'
        );
        echo form_open('login/validatelogin',$attributes);
        $data1 = array(
            
            'name' => 'username',
            'id' => 'usermane',
            'value' => ''
        );
        $data2 = array(
            
            'name' => 'password',
            'id' => 'password',
            'value' => ''
        );
        $submit = array(
            
            'name' => 'submit',
            'id' => 'submit',
            'value' => 'Login'
        );
        
        echo form_label('Username');
        echo form_input($data1);
        echo form_error('username');
        echo form_label('Password');
        echo form_password($data2);
        echo form_error('password');
        echo form_submit($submit,'Login');    
        ?>
                    
   </div>
<?php   echo form_close(); ?>
  </div>