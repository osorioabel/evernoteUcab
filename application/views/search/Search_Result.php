<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div id="main">
    <div class="wrapper">
        <!-- content -->
        <div id="content">
            <!-- title -->
            <div id="page-title">
                <span class="title">Search</span>
                <span class="subtitle">Evernote Ucab</span>
            </div>
            
            
             <div id="main">
            <div class="wrapper">		
                <!-- content -->
                <div id="content"> 
                    <div id="projects-list">
            
                        
                        
                    
             <?php
                        if (isset($records)):

                            foreach ($records as $c):
            
              
                $attributes = array('id' => 'sc-contact-form');
                echo form_open('/search/indexsearchResult/' . $username . '/' . $this->input->post('goal'), $attributes);
                ?>
            
              <div class='project'>
                          <h1><a href="#"> <?php echo $c->titulo ?> </a></h1>
                          
                           <!-- shadow -->
                                <div class='project-shadow'>
                                    <!-- project-thumb -->
                                  

                                       
       
                 
                
                
                 <a title='An image'><img src='/evernoteUcab/images/home.png' /></a>
                 
                 
                 
                                  </div>	
                                 
             </div>   
                     
                  <?php echo form_close(); 
                  
                     endforeach;

                        endif;
                  ?>
                         </div> 
                    
                    </div> 
            </div> 
        </div>        
                    
         </div>
        
    </div>
    
 </div>