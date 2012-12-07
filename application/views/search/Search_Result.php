<?php
if ($messi)
    echo $messi;
?>
<div id="main">
    <div class="wrapper">
        <!-- content -->
    
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
           ?>   
 <?php
        

                    $attributes = array('id' => 'sc-contact-form');
                    $ref = base_url() . 'search/indexshowresult/' . $username .'/'.$c->id_nota . '>';
                    echo form_open('/search/indexshowresult/' . $username.'/'.$c->id_nota, $attributes);
?>
            <div>
                       
                        <input name="goal"  id="goal" hidden ="true" value="<?php echo $busqueda ?>"
                               type="text" class="form-poshytip"   title="Enter a tittle" />
                          
            </div>  
        

<div class='project'>
                      
                       
                      <h1><a href="<?php echo $ref ?>"> <?php echo $c->titulo ?> </a></h1>

                               <!-- shadow -->
                               <div class='project-shadow'>
                                   <!-- project-thumb -->
                                   <a title='An image'><img src='/evernoteUcab/images/notaSmall.jpg' /></a>
                               
                               <div class='the-excerpt'>
                                   <?php echo $c->texto ?> 

                               </div>
                               
                               </div>
                             
                                         
                     </div>   
                            
        <?php
        echo form_close();

    endforeach;

endif;
        ?>
                         
                    </div> 
                     <?php echo $this->pagination->create_links(); ?>   
                    
                    </div> 
            </div> 
        </div>        
                    
         </div>
        
