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
            
             <?php
                        if (isset($records)):

                            foreach ($records as $c):
            
              
                $attributes = array('id' => 'sc-contact-form');
                echo form_open('/Search/indexsearchResult/' . $username . '/' . $this->input->post('goal'), $attributes);
                ?>
            <fieldset>
             <div>
                        <label>WTF</label>
                        <input name="goal"  id="tittleNote" 
                               type="text" class="form-poshytip"  title="Enter a tittle" />
            </div>
                 <p><input type="submit" value="Search" name="submit" id="submit" /></p>
                 
                   <?php echo $c->titulo ?> 
                 
                 
                 
                <?php echo $this->table->generate($records2);?>
                       </fieldset>
                  <?php echo form_close(); 
                  
                     endforeach;

                        endif;
                        ?>
         </div>
        
    </div>
    
 </div>